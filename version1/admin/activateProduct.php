<?php
include '../_base.php';
auth('Root', 'Admin');
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'product_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$category_filter = isset($_GET['category']) ? $_GET['category'] : ''; // Category filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
// Check if product_ids are posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
    $product_ids = $_POST['product_ids'];

    if (!empty($product_ids)) {
        // Prepare placeholders for SQL
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

        // Prepare the SQL query to activate only unavailable products
        $sql = "UPDATE product SET status = 'Available' WHERE product_id IN ($placeholders) AND status != 'Available'";
        $stm = $_db->prepare($sql);

        if ($stm->execute($product_ids)) {
            $affected_rows = $stm->rowCount();
            if ($affected_rows > 0) {
                temp('info', "$affected_rows products have been activated successfully.");
            } else {
                temp('info', 'No products were activated because they were already available.');
            }
        } else {
            temp('info', 'Failed to activate the product(s).');
        }

        redirect('productList.php?page='. $page .'&search=' . urlencode($search_query) . '&category=' . urlencode($category_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));

        exit;
    } else {
        temp('info', 'No products were selected for activation.');
        redirect('productList.php?page='. $page .'&search=' . urlencode($search_query) . '&category=' . urlencode($category_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
        exit;
    }
}