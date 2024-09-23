<?php
include '../_base.php';
auth('Root', 'Admin');
// Check if category_ids are posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_ids'])) {
    $category_ids = $_POST['category_ids'];

    if (!empty($category_ids)) {
        // Prepare placeholders for SQL
        $placeholders = implode(',', array_fill(0, count($category_ids), '?'));

        // Prepare the SQL query to deactivate only active categories
        $sql = "UPDATE category SET category_status = 'Unavailable' WHERE category_id IN ($placeholders) AND category_status != 'Unavailable'";
        $stm = $_db->prepare($sql);

        if ($stm->execute($category_ids)) {
            $affected_rows = $stm->rowCount();
            if ($affected_rows > 0) {
                temp('info', "$affected_rows categories have been deactivated successfully.");
            } else {
                temp('info', 'No categories were deactivated because they were already inactive.');
            }
        } else {
            temp('info', 'Failed to deactivate the category(s).');
        }

        redirect('categoryList.php');
        exit;
    } else {
        temp('info', 'No categories were selected for deactivation.');
        redirect('categoryList.php');
        exit;
    }
}