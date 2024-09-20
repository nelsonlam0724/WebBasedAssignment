<?php
// Include necessary files
include '../_base.php';

// Ensure only authorized users (Admin/Root) can deactivate a user
auth('Root', 'Admin');

// Get the user ID to deactivate, ensuring it's treated as a string
$user_id = isset($_POST['id']) ? trim($_POST['id']) : '';

if (!empty($user_id)) {
    // Prepare the SQL to deactivate the user (assuming 'Banned' is the status for deactivated users)
    $sql = 'UPDATE user SET status = "Active" WHERE user_id = ?';
    
    $stm = $_db->prepare($sql);
    
    if ($stm->execute([$user_id])) {
        // Redirect with a success message after deactivation
        temp('info', 'User Active successfully!');
        redirect('userList.php');
        exit;
    } else {
        // If the deactivation fails, set an error message
        temp('info', 'Failed to Active user.');
        redirect('userList.php');
        exit;
    }
} else {
    // If no valid user ID is provided, redirect with an error message
    temp('info', 'Invalid user ID.');
    redirect('userList.php');
    exit;
}
?>
