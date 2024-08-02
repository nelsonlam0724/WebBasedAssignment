<?php


date_default_timezone_set('Asia/Kuala_Lumpur');


function is_get() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}


function is_post() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}


function get($key, $value = null) {
    $value = $_GET[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}


function post($key, $value = null) {
    $value = $_POST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}


function req($key, $value = null) {
    $value = $_REQUEST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

?>