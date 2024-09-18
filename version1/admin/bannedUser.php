<?php
// Include necessary files
include '../_base.php';

// Ensure only authorized users (Admin/Root) can deactivate a user
auth('Root', 'Admin'); 

// Get the user ID to deactivate
$user_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($user_id > 0) {
    // Prepare the SQL to deactivate the user (assuming 'inactive' is the status for deactivated users)
    $sql = 'UPDATE user SET status = "Banned" WHERE user_id = ?';
    
    $stm = $_db->prepare($sql);
    
    if ($stm->execute([$user_id])) {
        // Redirect with a success message after deactivation
        temp('info','User banned successfully!');
        redirect('userList.php');
        exit;
    } else {
        // If the deactivation fails, set an error message
        temp('info','Failed to banned user.');
        redirect('userList.php');
        exit;
    }
} else {
    // If no valid user ID is provided, redirect with an error message
    temp('info','Invalid user ID.');
    redirect('userList.php');
    exit;
}
?>
