<?php
// Include necessary files
include '../_base.php';
include '../_head.php';

// Ensure only authorized users (Admin/Root) can deactivate a user
auth('Root', 'Admin');

// Get the user ID to deactivate
$user_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($user_id > 0) {
    $sql = 'UPDATE user SET status = ? WHERE user_id = ?';

    $stm = $_db->prepare($sql);
    if ($stm->execute(['Banned', $user_id])) {
        temp('info', 'User Banned successfully!');
        redirect('userList.php');
        exit;
    } else {
        temp('info', 'Failed to Banned user.');
        redirect('userList.php');
        exit;
    }
} else {
    temp('info', 'Invalid user ID.');
    redirect('userList.php');
    exit;
}
?>
