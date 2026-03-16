<?php
include('includes/config.php');
include('includes/room_order_helpers.php');

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$roomId = isset($_GET['room']) ? (int)$_GET['room'] : 0;
$token = isset($_GET['token']) ? $_GET['token'] : '';
$message = '';
$messageType = 'danger';

if ($roomId <= 0 || $token == '') {
    die('Invalid link');
}

$result = mysql_query("SELECT * FROM `devices` WHERE `ID` = '$roomId' LIMIT 1");
$device = mysql_fetch_array($result);
if (!$device) {
    die('Room not found');
}

$expectedToken = room_order_token($roomId, $device['Device Name']);
if ($token !== $expectedToken) {
    die('Invalid token');
}

$sessionId = $device['session_id'];
if ($device['Device Status'] !== 'On' || $sessionId == '') {
    $message = 'الروم غير مفتوح حالياً. اطلب من الكاشير تشغيل الروم أولاً.';
}

$products = array();
$stockSql = "SELECT name, catagory, sub_cat, MAX(price) AS price, SUM(stock - sold) AS available
             FROM stock
             GROUP BY name, catagory, sub_cat
             HAVING available > 0
             ORDER BY catagory, sub_cat, name";
$stockResult = mysql_query($stockSql);
while ($row = mysql_fetch_assoc($stockResult)) {
    $products[] = $row;
}
?><!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>قائمة الروم <?php echo htmlspecialchars($device['Device Name']); ?></title>
<link rel="stylesheet" href="css/bootstrap-classic.min.css">
<style>
body{background:#f5f5f5;font-family:Tahoma}
.wrap{max-width:900px;margin:20px auto;background:#fff;padding:15px;border-radius:10px}
.tbl input{width:70px}
</style>
</head>
<body>
<div class="wrap">
    <h3>طلبات روم: <?php echo htmlspecialchars($device['Device Name']); ?></h3>
    <p>اختر الكمية ثم اضغط <b>تأكيد الطلب</b> وسيتم إضافتها تلقائياً على حساب الروم الحالي.</p>

    <?php if ($message != '') { ?>
        <div class="alert alert-<?php echo $messageType; ?>"><?php echo $message; ?></div>
    <?php } ?>

    <?php if ($message == '') { ?>
    <form method="POST" action="actions/ps/room_order_add.php">
        <input type="hidden" name="room" value="<?php echo $roomId; ?>">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <table class="table table-bordered tbl">
            <thead>
                <tr>
                    <th>الصنف</th>
                    <th>القسم</th>
                    <th>متاح</th>
                    <th>السعر</th>
                    <th>الكمية</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $index => $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['catagory'] . ' / ' . $item['sub_cat']); ?></td>
                    <td><?php echo (int)$item['available']; ?></td>
                    <td><?php echo (float)$item['price']; ?></td>
                    <td>
                        <input type="hidden" name="items[<?php echo $index; ?>][name]" value="<?php echo htmlspecialchars($item['name']); ?>">
                        <input type="number" min="0" max="<?php echo (int)$item['available']; ?>" value="0" name="items[<?php echo $index; ?>][qty]">
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success">تأكيد الطلب</button>
    </form>
    <?php } ?>
</div>
</body>
</html>
