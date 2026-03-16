<?php

function room_order_token($roomId, $deviceName)
{
    $secret = 'ps-room-order-secret';
    return md5($secret . '|' . (int)$roomId . '|' . $deviceName);
}

function room_order_build_base_url()
{
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && (int)$_SERVER['SERVER_PORT'] === 443);
    $scheme = $isHttps ? 'https' : 'http';
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
    $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    if ($basePath === '.' || $basePath === '/') {
        $basePath = '';
    }

    return $scheme . '://' . $host . $basePath;
}
