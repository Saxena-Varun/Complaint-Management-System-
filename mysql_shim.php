<?php
/**
 * MySQL compatibility shim for PHP 7+/8+
 * Maps removed mysql_* functions to their mysqli_* equivalents.
 * Include this file from config.php AFTER the connection is established.
 */

// Store the global connection so all shim functions can use it
global $__mysql_shim_link;

function mysql_connect($host, $user, $pass) {
    global $__mysql_shim_link;
    $port = 3306;
    if (strpos($host, ':') !== false) {
        list($host, $port) = explode(':', $host, 2);
        $port = (int)$port;
    }
    $__mysql_shim_link = @mysqli_connect($host, $user, $pass, '', $port);
    if (!$__mysql_shim_link) {
        return false;
    }
    return $__mysql_shim_link;
}

function mysql_select_db($db, $link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_select_db($conn, $db);
}

function mysql_query($sql, $link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_query($conn, $sql);
}

function mysql_fetch_array($result, $type = MYSQLI_BOTH) {
    return mysqli_fetch_array($result, $type);
}

function mysql_fetch_assoc($result) {
    return mysqli_fetch_assoc($result);
}

function mysql_fetch_row($result) {
    return mysqli_fetch_row($result);
}

function mysql_fetch_object($result) {
    return mysqli_fetch_object($result);
}

function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

function mysql_affected_rows($link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_affected_rows($conn);
}

function mysql_insert_id($link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_insert_id($conn);
}

function mysql_real_escape_string($str, $link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_real_escape_string($conn, $str);
}

function mysql_error($link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_error($conn);
}

function mysql_errno($link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_errno($conn);
}

function mysql_free_result($result) {
    return mysqli_free_result($result);
}

function mysql_close($link = null) {
    global $__mysql_shim_link;
    $conn = $link ?: $__mysql_shim_link;
    return mysqli_close($conn);
}

function mysql_data_seek($result, $offset) {
    return mysqli_data_seek($result, $offset);
}

function mysql_field_name($result, $field_index) {
    $field = mysqli_fetch_field_direct($result, $field_index);
    return $field ? $field->name : false;
}

function mysql_num_fields($result) {
    return mysqli_num_fields($result);
}
?>
