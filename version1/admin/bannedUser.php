<?php
include '../_base.php';

auth('Root', 'Admin');

// Get the user ID to deactivate, ensuring it's treated as a string
$user_id = isset($_POST['id']) ? trim($_POST['id']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($user_id)) {
    // Prepare the SQL to deactivate the user (assuming 'Banned' is the status for deactivated users)
    $sql = 'UPDATE user SET status = "Banned" WHERE user_id = ?';
    
    $stm = $_db->prepare($sql);
    
    if ($stm->execute([$user_id])) {
        // Redirect with a success message after deactivation
        temp('info', 'User banned successfully!');
        redirect('userList.php?page=' . $page . '&search=' . urlencode($search_query));
        exit;
    } else {
        // If the deactivation fails, set an error message
        temp('info', 'Failed to ban user.');
        redirect('userList.php?page=' . $page . '&search=' . urlencode($search_query));
        exit;
    }
} else {
    // If no valid user ID is provided, redirect with an error message
    temp('info', 'Invalid user ID.');
    redirect('userList.php?page=' . $page . '&search=' . urlencode($search_query));
    exit;
}
?>
