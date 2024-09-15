<?php
include '../_base.php';
include '../_head.php';

auth('Root');

// Check if the form is submitted
if (is_post()) {
    // Get the user ID from the form
    $user_id = req('user_id');

    // Fetch the role of the user to be deleted
    $stm = $_db->prepare('SELECT role FROM user WHERE user_id = ?');
    $stm->execute([$user_id]);
    $user = $stm->fetch(PDO::FETCH_OBJ);

    // Check if the user exists and is not a 'Root'
    if ($user && $user->role === 'Root') {
        // Prevent deletion of root users
        temp('info', 'Root users cannot be deleted.');
    } else {
        $stm = $_db->prepare('DELETE FROM user WHERE user_id = ?');
        $stm->execute([$user_id]);

        temp('info', 'User deleted successfully.');
    }

    redirect('userList.php');
}

// Redirect if accessed without POST data
redirect('userList.php');
?>
