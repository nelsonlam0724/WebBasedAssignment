<?php

//PHP Setups
date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

//GETPOST
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

function redirect($url = null) {
    $url ??= $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
}

function temp($key, $value = null) {
    if($value !== null) {
        $SEESION["temp_$key"] = $value;
    } else {
        $value = $_SESSION["temp_$key"] ?? null;
        unset($_SESSION["temp_$key"]);
        return $value;
    }
}

//Generate input type


//Setup DB
$_db = new PDO('mysql:dbname=web_ass','root','',[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);


?>