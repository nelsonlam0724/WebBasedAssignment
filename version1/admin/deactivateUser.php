<?php
// Include necessary files
include '../_base.php';

// Ensure only authorized users (Admin/Root) can deactivate a user
auth('Root', 'Admin');

// Get the user ID to deactivate
$user_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$deactivated_at = date('Y-m-d H:i:s'); // Get current time

if ($user_id > 0) {
    $sql = 'UPDATE user SET status = ?, deactivated_at = ? WHERE user_id = ?';

    $stm = $_db->prepare($sql);
    if ($stm->execute(['Deactivate', $deactivated_at, $user_id])) {
        temp('info', 'User deactivated successfully!');
        redirect('userList.php');
        exit;
    } else {
        temp('info', 'Failed to deactivate user.');
        redirect('userList.php');
        exit;
    }
} else {
    temp('info', 'Invalid user ID.');
    redirect('userList.php');
    exit;
}
?>
