<?php session_start();
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['ps_user'])) {
    echo json_encode(array('ok' => false, 'error' => 'unauthorized'));
    exit;
}

include('../../includes/config.php');
mysql_connect("$host", "$user", "$pass") or die(json_encode(array('ok' => false, 'error' => 'db-connect')));
mysql_select_db("$db") or die(json_encode(array('ok' => false, 'error' => 'db-select')));

$sql = "SELECT * FROM `notes` WHERE `seen` = 'no' AND (`note` LIKE '[ROOM_ORDER_B64]%' OR `note` LIKE '[ROOM_ORDER]%') ORDER BY `id` ASC LIMIT 1";
$result = mysql_query($sql);
if (!$result) {
    echo json_encode(array('ok' => false, 'error' => 'query-failed'));
    exit;
}

$row = mysql_fetch_array($result);
if (!$row) {
    echo json_encode(array('ok' => true, 'has_alert' => false));
    exit;
}

$noteId = (int)$row['id'];
$noteText = $row['note'];
$room = '';
$order = '';
$message = trim(str_replace('[ROOM_ORDER]', '', $noteText));

if (strpos($noteText, '[ROOM_ORDER_B64]') === 0) {
    $raw = substr($noteText, strlen('[ROOM_ORDER_B64]'));
    $decoded = base64_decode($raw, true);
    if ($decoded !== false) {
        $payload = json_decode($decoded, true);
        if (is_array($payload)) {
            $room = isset($payload['room']) ? trim((string)$payload['room']) : '';
            $order = isset($payload['order']) ? trim((string)$payload['order']) : '';
            $message = 'Room ' . $room . ': ' . $order;
        }
    }
} elseif (strpos($noteText, '[ROOM_ORDER]|') === 0) {
    $parts = explode('|', $noteText, 3);
    $room = isset($parts[1]) ? trim($parts[1]) : '';
    $order = isset($parts[2]) ? trim($parts[2]) : '';
    $message = 'Room ' . $room . ': ' . $order;
}

mysql_query("UPDATE `notes` SET `seen` = 'yes' WHERE `id` = '$noteId'");

echo json_encode(array(
    'ok' => true,
    'has_alert' => true,
    'id' => $noteId,
    'message' => $message,
    'room' => $room,
    'order' => $order,
));
exit;
