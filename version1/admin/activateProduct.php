<?php
include '../_base.php';

// Check if product_ids are posted for activation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
    $product_ids = $_POST['product_ids'];

    if (!empty($product_ids)) {
        // Prepare placeholders for SQL
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

        // Prepare the SQL query to activate only inactive products
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

        redirect('productList.php');
        exit;
    } else {
        temp('info', 'No products were selected for activation.');
        redirect('productList.php');
        exit;
    }
} else {
    temp('info', 'You cannot activate without selecting products.');
    redirect('productList.php');
    exit;
}
