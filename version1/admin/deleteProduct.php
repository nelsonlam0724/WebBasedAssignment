<?php
include '../_base.php'; // Include your database connection and base files

// Check if product_ids are posted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_ids'])) {
    $product_ids = $_POST['product_ids'];

    if (!empty($product_ids)) {
        // Convert the array of product IDs into a comma-separated string for SQL
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

        // Prepare the SQL query to delete the products
        $sql = "DELETE FROM product WHERE product_id IN ($placeholders)";

        // Execute the deletion
        $stm = $_db->prepare($sql);

        if ($stm->execute($product_ids)) {
            // Successful deletion message
            $_SESSION['success_message'] = "Selected products have been deleted successfully.";
        } else {
            // Error message if deletion failed
            $_SESSION['error_message'] = "There was an error deleting the products.";
        }
    } else {
        // No products selected
        $_SESSION['error_message'] = "No products were selected for deletion.";
    }
} else {
    // Invalid request
    $_SESSION['error_message'] = "Invalid request.";
}

// Redirect back to product list after deletion
header('Location: productList.php');
exit;
?>