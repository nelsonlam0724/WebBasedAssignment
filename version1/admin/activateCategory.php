<?php
include '../_base.php';
auth('Root', 'Admin');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_ids'])) {
    $category_ids = $_POST['category_ids'];

    // Check if category_ids is an array
    if (is_array($category_ids) && !empty($category_ids)) {
        // Prepare placeholders for SQL
        $placeholders = implode(',', array_fill(0, count($category_ids), '?'));

        // Prepare the SQL query to activate only unavailable categories
        $sql = "UPDATE category SET category_status = 'Available' WHERE category_id IN ($placeholders) AND category_status != 'Available'";
        $stm = $_db->prepare($sql);

        if ($stm->execute($category_ids)) {
            $affected_rows = $stm->rowCount();
            if ($affected_rows > 0) {
                temp('info', "$affected_rows categories have been activated successfully.");
            } else {
                temp('info', 'No categories were activated because they were already active.');
            }
        } else {
            temp('info', 'Failed to activate the category(s).');
        }

        redirect('categoryList.php');
        exit;
    } else {
        temp('info', 'No categories were selected for activation.');
        redirect('categoryList.php');
        exit;
    }
}