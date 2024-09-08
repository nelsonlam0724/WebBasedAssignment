<?php
include '_base.php';

// Check if there is a remember me token to clear
if (isset($_COOKIE['remember_token'])) {
    // Clear the token in the database
    $stm = $_db->prepare('UPDATE user SET remember_token = NULL, remember_token_expiry = NULL WHERE remember_token = ?');
    $stm->execute([$_COOKIE['remember_token']]);

    // Delete the cookie
    setcookie('remember_token', '', time() - 3600, '/', '', false, true);
}

session_destroy();

// Redirect to the login page
logout('login.php');
