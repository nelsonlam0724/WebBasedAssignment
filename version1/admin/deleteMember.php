<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if ($u->role !="Admin") {
        temp('info', 'Please Login');
        redirect('../login.php');
    }
    
}

// Check if the form is submitted
if (is_post()) {
    // Get the member ID from the form
    $user_id = req('user_id');

    // Delete the member from the database
    $stm = $_db->prepare('DELETE FROM user WHERE user_id = ?');
    $stm->execute([$user_id]);

    temp('info', 'Member deleted successfully');
    redirect('memberList.php');
}

// Redirect if accessed without POST data
redirect('memberList.php');
?>