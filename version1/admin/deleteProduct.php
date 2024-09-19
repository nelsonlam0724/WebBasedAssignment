<?php
include '../_base.php';

// Check if product_ids are posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
    $product_ids = $_POST['product_ids'];

    if (!empty($product_ids)) {
        // Check for already deactivated products
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $sql_check = "SELECT product_id FROM product WHERE product_id IN ($placeholders) AND status = 'Unavailable'";
        $stm_check = $_db->prepare($sql_check);
        $stm_check->execute($product_ids);
        $deactivated_products = $stm_check->fetchAll(PDO::FETCH_COLUMN);

        if (!empty($deactivated_products)) {
            // Store error message for already deactivated products
            temp('info', 'User banned successfully!');
            redirect('productList.php');
            exit;
        }

        // Prepare the SQL query to deactivate the products
        $sql = "UPDATE product SET status = 'Unavailable' WHERE product_id IN ($placeholders)";

        // Execute the update
        $stm = $_db->prepare($sql);

        if ($stm->execute($product_ids)) {
            temp('info', 'Selected products have been deactivated successfully.');
            redirect('productList.php');
            exit;
        } else {
            temp('info', 'Failed to deactivate the product(s).');
            redirect('productList.php');
            exit;
        }
    } else {
        temp('info', 'No products were selected for deactivation.');
        redirect('productList.php');
        exit;
    }
} else {
    temp('info', 'Invalid product deactivating error.');
    redirect('productList.php');
    exit;
}
