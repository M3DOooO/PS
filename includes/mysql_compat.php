<?php
/**
 * Legacy mysql_* compatibility layer for PHP 8+.
 *
 * This allows the existing codebase (written for PHP 5.x mysql extension)
 * to run on modern PHP versions using mysqli underneath.
 */

if (!function_exists('mysql_connect')) {
    if (function_exists('mysqli_report')) {
        mysqli_report(MYSQLI_REPORT_OFF);
    }

    $GLOBALS['__mysql_compat_connections'] = [];
    $GLOBALS['__mysql_compat_last_connection'] = null;

    function mysql_connect($server = null, $username = null, $password = null, $new_link = false, $client_flags = 0)
    {
        $server = $server ?: ini_get('mysqli.default_host');
        $username = $username ?: ini_get('mysqli.default_user');
        $password = $password ?: ini_get('mysqli.default_pw');

        $key = md5((string)$server . '|' . (string)$username . '|' . (string)$password);

        if (!$new_link && isset($GLOBALS['__mysql_compat_connections'][$key])) {
            $GLOBALS['__mysql_compat_last_connection'] = $GLOBALS['__mysql_compat_connections'][$key];
            return $GLOBALS['__mysql_compat_last_connection'];
        }

        $link = @mysqli_connect($server, $username, $password);
        if (!$link) {
            return false;
        }

        mysqli_set_charset($link, 'utf8mb4');
        $GLOBALS['__mysql_compat_connections'][$key] = $link;
        $GLOBALS['__mysql_compat_last_connection'] = $link;

        return $link;
    }

    function mysql_select_db($database_name, $link_identifier = null)
    {
        $link = $link_identifier ?: ($GLOBALS['__mysql_compat_last_connection'] ?? null);
        if (!$link) {
            return false;
        }

        return @mysqli_select_db($link, $database_name);
    }

    function mysql_query($query, $link_identifier = null)
    {
        $link = $link_identifier ?: ($GLOBALS['__mysql_compat_last_connection'] ?? null);
        if (!$link) {
            return false;
        }

        return @mysqli_query($link, $query);
    }

    function mysql_fetch_array($result, $result_type = MYSQLI_BOTH)
    {
        return mysqli_fetch_array($result, $result_type);
    }

    function mysql_fetch_assoc($result)
    {
        return mysqli_fetch_assoc($result);
    }

    function mysql_fetch_row($result)
    {
        return mysqli_fetch_row($result);
    }

    function mysql_num_rows($result)
    {
        return mysqli_num_rows($result);
    }

    function mysql_num_fields($result)
    {
        return mysqli_num_fields($result);
    }


    function mysql_real_escape_string($unescaped_string, $link_identifier = null)
    {
        $link = $link_identifier ?: ($GLOBALS['__mysql_compat_last_connection'] ?? null);
        if (!$link) {
            return addslashes((string)$unescaped_string);
        }

        return mysqli_real_escape_string($link, (string)$unescaped_string);
    }

    function mysql_error($link_identifier = null)
    {
        $link = $link_identifier ?: ($GLOBALS['__mysql_compat_last_connection'] ?? null);
        if ($link) {
            return mysqli_error($link);
        }

        return mysqli_connect_error();
    }

    function mysql_close($link_identifier = null)
    {
        $link = $link_identifier ?: ($GLOBALS['__mysql_compat_last_connection'] ?? null);
        if (!$link) {
            return true;
        }

        foreach ($GLOBALS['__mysql_compat_connections'] as $key => $connection) {
            if ($connection === $link) {
                unset($GLOBALS['__mysql_compat_connections'][$key]);
            }
        }

        if (($GLOBALS['__mysql_compat_last_connection'] ?? null) === $link) {
            $GLOBALS['__mysql_compat_last_connection'] = null;
        }

        return mysqli_close($link);
    }
}
