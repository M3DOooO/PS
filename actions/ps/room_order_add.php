<?php
session_start();
include('../../includes/config.php');
include('../../includes/room_order_helpers.php');

function room_order_redirect($roomId, $token, $error = '')
{
    $url = '../../room_menu.php?room=' . (int)$roomId . '&token=' . urlencode($token);
    if ($error !== '') {
        $url .= '&err=' . urlencode($error);
    }
    header('Location: ' . $url);
    exit;
}

function room_order_fail($roomId, $token, $code)
{
    $dbErr = mysql_error();
    $suffix = ($dbErr !== '') ? ('-' . substr(md5($dbErr), 0, 6)) : '';
    room_order_redirect($roomId, $token, $code . $suffix);
}

mysql_connect("$host", "$user", "$pass")or die("cannot connect");
mysql_select_db("$db")or die("cannot select DB");

$roomId = isset($_POST['room']) ? (int)$_POST['room'] : 0;
$token = isset($_POST['token']) ? $_POST['token'] : '';
$items = (isset($_POST['items']) && is_array($_POST['items'])) ? $_POST['items'] : array();

if ($roomId <= 0 || $token == '') {
    header('Location: ../../devices.php');
    exit;
}

$result = mysql_query("SELECT * FROM `devices` WHERE `ID` = '$roomId' LIMIT 1");
if (!$result) {
    room_order_fail($roomId, $token, 'E-DVC-Q');
}
$device = mysql_fetch_array($result);
if (!$device) {
    header('Location: ../../devices.php');
    exit;
}

$expectedToken = room_order_token($roomId, $device['Device Name']);
if ($token !== $expectedToken) {
    room_order_redirect($roomId, $token, 'E-TOKEN');
}

$sessionId = $device['session_id'];
if ($device['Device Status'] !== 'On' || $sessionId == '') {
    room_order_redirect($roomId, $token, 'E-ROOM');
}

$Hour = idate('H');
$Year = idate('Y');
$orderedItems = array();
$roomName = isset($device['Device Name']) ? $device['Device Name'] : ('#' . $roomId);

foreach ($items as $item) {
    $name = isset($item['name']) ? trim($item['name']) : '';
    $qty = isset($item['qty']) ? (int)$item['qty'] : 0;
    $availableFromMenu = isset($item['available']) ? (int)$item['available'] : 0;

    if ($name === '' || $qty <= 0) {
        continue;
    }

    if ($qty > 8) {
        $qty = 8;
    }
    if ($availableFromMenu > 0 && $qty > $availableFromMenu) {
        $qty = $availableFromMenu;
    }

    $nameEsc = mysql_real_escape_string($name);

    $minDateResult = mysql_query("SELECT MIN(date) AS mindate FROM `stock` WHERE `name` = '$nameEsc' AND (`stock` - `sold`) > 0");
    if (!$minDateResult) {
        room_order_fail($roomId, $token, 'E-STOCK-MIN');
    }
    $minDateRow = mysql_fetch_array($minDateResult);
    $mindate = $minDateRow['mindate'];
    if (!$mindate) {
        continue;
    }

    $stockResult = mysql_query("SELECT * FROM `stock` WHERE `name` = '$nameEsc' AND `date` = '$mindate' LIMIT 1");
    if (!$stockResult) {
        room_order_fail($roomId, $token, 'E-STOCK-ROW');
    }
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

    $catagory = mysql_real_escape_string($stockRow['catagory']);
    $subCat = mysql_real_escape_string($stockRow['sub_cat']);
    $unitPrice = (float)$stockRow['price'];
    $total = $unitPrice * $finalQty;
    $newSold = (int)$stockRow['sold'] + $finalQty;

    $insertOrder = mysql_query("INSERT INTO `ps_orders` (`catagory`, `sub_cat`, `name`, `price`, `num`, `ps_id`, `session_id`, `day`, `month`, `year`, `hour`) VALUES ('$catagory', '$subCat', '$nameEsc', '$total', '$finalQty', '$roomId', '$sessionId', '$shift_day', '$shift_month', '$Year', '$Hour')");
    if (!$insertOrder) {
        room_order_fail($roomId, $token, 'E-ORDER-INS');
    }

    $updateStock = mysql_query("UPDATE `stock` SET `sold` = '$newSold' WHERE `name` = '$nameEsc' AND `date` = '$mindate'");
    if (!$updateStock) {
        room_order_fail($roomId, $token, 'E-STOCK-UPD');
    }

    $recipeResult = mysql_query("SELECT * FROM `recipe` WHERE `item` = '$nameEsc'");
    if (!$recipeResult) {
        room_order_fail($roomId, $token, 'E-RECIPE-Q');
    }

    while ($recipeRow = mysql_fetch_array($recipeResult)) {
        $ingName = mysql_real_escape_string($recipeRow['ing_name']);
        $ingQtyNeed = $recipeRow['ing_qty'] * $finalQty;

        $ingMinDateResult = mysql_query("SELECT MIN(date) AS mindate FROM `ingredients` WHERE `name` = '$ingName' AND (`stock` - `sold`) >= '$ingQtyNeed'");
        if (!$ingMinDateResult) {
            room_order_fail($roomId, $token, 'E-ING-MIN');
        }

        $ingMinDateRow = mysql_fetch_array($ingMinDateResult);
        $ingMinDate = $ingMinDateRow['mindate'];
        if (!$ingMinDate) {
            continue;
        }

        $ingResult = mysql_query("SELECT * FROM `ingredients` WHERE `name` = '$ingName' AND `date` = '$ingMinDate' LIMIT 1");
        if (!$ingResult) {
            room_order_fail($roomId, $token, 'E-ING-ROW');
        }

        $ingRow = mysql_fetch_array($ingResult);
        if (!$ingRow) {
            continue;
        }

        $newIngSold = (float)$ingRow['sold'] + $ingQtyNeed;
        $ingUpdate = mysql_query("UPDATE `ingredients` SET `sold` = '$newIngSold' WHERE `name` = '$ingName' AND `date` = '$ingMinDate'");
        if (!$ingUpdate) {
            room_order_fail($roomId, $token, 'E-ING-UPD');
        }

        $newIngAvl = (float)$recipeRow['ing_avl'] - $ingQtyNeed;
        $recipeUpdate = mysql_query("UPDATE `recipe` SET `ing_avl` = '$newIngAvl' WHERE `ing_name` = '$ingName'");
        if (!$recipeUpdate) {
            room_order_fail($roomId, $token, 'E-RECIPE-UPD');
        }
    }

    $orderedItems[] = $name . ' x' . $finalQty;
}

if (count($orderedItems) > 0) {
    $noteText = '[ROOM_ORDER]|' . $roomName . '|' . implode(', ', $orderedItems);
    $noteTextEsc = mysql_real_escape_string($noteText);
    $noteHour = idate('H');
    $noteYear = idate('Y');
    mysql_query("INSERT INTO `notes` (`note`,`day`,`month`,`year`,`shift`,`casheer`,`hour`,`seen`) VALUES ('$noteTextEsc','$shift_day','$shift_month','$noteYear','$current_shift','QR','$noteHour','no')");
}

header('Location: ../../room_menu.php?room=' . $roomId . '&token=' . urlencode($token) . '&ok=1');
exit;
