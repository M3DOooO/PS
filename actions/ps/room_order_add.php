<?php
include('../../includes/config.php');
include('../../includes/room_order_helpers.php');

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$roomId = isset($_POST['room']) ? (int)$_POST['room'] : 0;
$token = isset($_POST['token']) ? $_POST['token'] : '';
$items = isset($_POST['items']) ? $_POST['items'] : array();

if ($roomId <= 0 || $token == '') {
    die('Invalid request');
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
    die('Room is not active');
}

$Hour = idate('H');
$Year = idate('Y');

foreach ($items as $item) {
    $name = isset($item['name']) ? trim($item['name']) : '';
    $qty = isset($item['qty']) ? (int)$item['qty'] : 0;

    if ($name === '' || $qty <= 0) {
        continue;
    }

    $nameEsc = mysql_real_escape_string($name);

    $minDateResult = mysql_query("SELECT MIN(date) AS mindate FROM `stock` WHERE `name` = '$nameEsc' AND (`stock` - `sold`) > 0");
    $minDateRow = mysql_fetch_array($minDateResult);
    $mindate = $minDateRow['mindate'];
    if (!$mindate) {
        continue;
    }

    $stockResult = mysql_query("SELECT * FROM `stock` WHERE `name` = '$nameEsc' AND `date` = '$mindate' LIMIT 1");
    $stockRow = mysql_fetch_array($stockResult);
    if (!$stockRow) {
        continue;
    }

    $available = (int)$stockRow['stock'] - (int)$stockRow['sold'];
    if ($available <= 0) {
        continue;
    }

    $finalQty = $qty > $available ? $available : $qty;
    if ($finalQty <= 0) {
        continue;
    }

    $catagory = $stockRow['catagory'];
    $subCat = $stockRow['sub_cat'];
    $unitPrice = (float)$stockRow['price'];
    $total = $unitPrice * $finalQty;
    $newSold = (int)$stockRow['sold'] + $finalQty;

    mysql_query("INSERT INTO `ps_orders` (`catagory`, `sub_cat`, `name`, `price`, `num`, `ps_id`, `session_id`, `day`, `month`, `year`, `hour`) VALUES ('" . mysql_real_escape_string($catagory) . "', '" . mysql_real_escape_string($subCat) . "', '$nameEsc', '$total', '$finalQty', '$roomId', '$sessionId', '$shift_day', '$shift_month', '$Year', '$Hour')");
    mysql_query("UPDATE `stock` SET `sold` = '$newSold' WHERE `name` = '$nameEsc' AND `date` = '$mindate'");

    $recipeResult = mysql_query("SELECT * FROM `recipe` WHERE `item` = '$nameEsc'");
    while ($recipeRow = mysql_fetch_array($recipeResult)) {
        $ingName = $recipeRow['ing_name'];
        $ingQtyNeed = $recipeRow['ing_qty'] * $finalQty;
        $ingEsc = mysql_real_escape_string($ingName);

        $ingMinDateResult = mysql_query("SELECT MIN(date) AS mindate FROM `ingredients` WHERE `name` = '$ingEsc' AND (`stock` - `sold`) >= '$ingQtyNeed'");
        $ingMinDateRow = mysql_fetch_array($ingMinDateResult);
        $ingMinDate = $ingMinDateRow['mindate'];
        if (!$ingMinDate) {
            continue;
        }

        $ingResult = mysql_query("SELECT * FROM `ingredients` WHERE `name` = '$ingEsc' AND `date` = '$ingMinDate' LIMIT 1");
        $ingRow = mysql_fetch_array($ingResult);
        if (!$ingRow) {
            continue;
        }

        $newIngSold = (float)$ingRow['sold'] + $ingQtyNeed;
        mysql_query("UPDATE `ingredients` SET `sold` = '$newIngSold' WHERE `name` = '$ingEsc' AND `date` = '$ingMinDate'");

        $newIngAvl = (float)$recipeRow['ing_avl'] - $ingQtyNeed;
        mysql_query("UPDATE `recipe` SET `ing_avl` = '$newIngAvl' WHERE `ing_name` = '$ingEsc'");
    }
}

header('Location: ../../room_menu.php?room=' . $roomId . '&token=' . urlencode($token) . '&ok=1');
exit;
