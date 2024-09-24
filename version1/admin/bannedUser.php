<?php
include '../_base.php';

auth('Root', 'Admin');

// Get the user ID to deactivate, ensuring it's treated as a string
$user_id = isset($_POST['id']) ? trim($_POST['id']) : '';
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$role_filter = isset($_GET['role']) ? trim($_GET['role']) : '';
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'user_id';
$sort_order = isset($_GET['sort_order']) ? trim($_GET['sort_order']) : 'ASC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if (!empty($user_id)) {
    // Prepare the SQL to deactivate the user (assuming 'Banned' is the status for deactivated users)
    $sql = 'UPDATE user SET status = "Banned" WHERE user_id = ?';
    
    $stm = $_db->prepare($sql);
    
    if ($stm->execute([$user_id])) {
        // Redirect with a success message after deactivation
        temp('info', 'User banned successfully!');
        redirect('userList.php?page='. $page .'&search=' . urlencode($search_query) . '&role=' . urlencode($role_filter) . '&status=' . urlencode($status_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
        exit;
    } else {
        // If the deactivation fails, set an error message
        temp('info', 'Failed to ban user.');
        redirect('userList.php?page='. $page .'&search=' . urlencode($search_query) . '&role=' . urlencode($role_filter) . '&status=' . urlencode($status_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
        exit;
    }
} else {
    // If no valid user ID is provided, redirect with an error message
    temp('info', 'Invalid user ID.');
    redirect('userList.php?page='. $page .'&search=' . urlencode($search_query) . '&role=' . urlencode($role_filter) . '&status=' . urlencode($status_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
    exit;
}
?>
