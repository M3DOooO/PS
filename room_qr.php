<?php session_start();
if (!isset($_SESSION['ps_user'])) {
    include('login.php');
    die();
}

include('includes/config.php');
include('includes/room_order_helpers.php');
if($lang == 'en'){include('languages/en.php');}else if($lang == 'ar'){include('languages/ar.php');}

$roomId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($roomId <= 0) {
    die('Invalid room id');
}

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$result = mysql_query("SELECT * FROM `devices` WHERE `ID` = '$roomId' LIMIT 1");
$device = mysql_fetch_array($result);
if (!$device) {
    die('Room not found');
}

$deviceName = $device['Device Name'];
$token = room_order_token($roomId, $deviceName);
$baseUrl = room_order_build_base_url();
$roomMenuUrl = $baseUrl . '/room_menu.php?room=' . $roomId . '&token=' . $token;
$qrUrl = 'https://quickchart.io/qr?text=' . urlencode($roomMenuUrl) . '&size=280';
?><!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<title>QR روم <?php echo htmlspecialchars($deviceName); ?></title>
<link rel="stylesheet" href="css/bootstrap-classic.min.css">
<style>
body{font-family:Tahoma;background:#f8f9fa;padding:20px;text-align:center}
.box{max-width:420px;margin:0 auto;background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.1)}
img{max-width:100%}
.url{direction:ltr;word-break:break-all;background:#f1f1f1;padding:8px;border-radius:6px;font-size:12px}
</style>
</head>
<body>
<div class="box">
    <h3>QR روم: <?php echo htmlspecialchars($deviceName); ?></h3>
    <p>اسكان الكود لعرض قائمة المنتجات وطلبها مباشرة على حساب الروم.</p>
    <img src="<?php echo $qrUrl; ?>" alt="Room QR">
    <p class="url"><?php echo htmlspecialchars($roomMenuUrl); ?></p>
    <a class="btn btn-primary" href="devices_ps.php?id=<?php echo $roomId; ?>">رجوع للروم</a>
</div>
</body>
</html>
