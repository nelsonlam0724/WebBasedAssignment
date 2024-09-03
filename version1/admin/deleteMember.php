<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE id = ?');
    $stm->execute([$_user->id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}


// Check if the form is submitted
if (is_post()) {
    // Get the member ID from the form
    $id = req('id');

    // Delete the member from the database
    $stm = $_db->prepare('DELETE FROM user WHERE id = ?');
    $stm->execute([$id]);

    temp('info', 'Member deleted successfully');
    redirect('memberList.php');
}

// Redirect if accessed without POST data
redirect('memberList.php');
?>