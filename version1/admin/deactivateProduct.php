<?php
include '../_base.php';

// Check if product_ids are posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
    $product_ids = $_POST['product_ids'];

    if (!empty($product_ids)) {
        // Prepare placeholders for SQL
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

        // Prepare the SQL query to deactivate only active products
        $sql = "UPDATE product SET status = 'Unavailable' WHERE product_id IN ($placeholders) AND status != 'Unavailable'";
        $stm = $_db->prepare($sql);

        if ($stm->execute($product_ids)) {
            $affected_rows = $stm->rowCount();
            if ($affected_rows > 0) {
                temp('info', "$affected_rows products have been deactivated successfully.");
            } else {
                temp('info', 'No products were deactivated because they were already unavailable.');
            }
        } else {
            temp('info', 'Failed to deactivate the product(s).');
        }

        redirect('productList.php');
        exit;
    } else {
        temp('info', 'No products were selected for deactivation.');
        redirect('productList.php');
        exit;
    }
}