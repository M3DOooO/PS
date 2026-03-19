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
$qrUrl = 'https://quickchart.io/qr?text=' . urlencode($roomMenuUrl) . '&size=900';
?><!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="utf-8">
<title>QR</title>
<style>
html,body{margin:0;padding:0;background:#fff;text-align:center}
img{display:block;margin:0 auto;max-width:100vw;max-height:100vh}
</style>
</head>
<body>
<img src="<?php echo $qrUrl; ?>" alt="Room QR">
</body>
</html>
