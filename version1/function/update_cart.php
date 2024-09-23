<?php
include '../_base.php';

if (is_post()) {

    $product_id = req('product_id'); 
    $quantity = req('quantity');
    $user_id = req('user');

 
    $stmt = $_db->prepare('SELECT quantity FROM product WHERE product_id = ?');
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();

    if ($product) {
        $stock_quantity = $product->quantity;

        if ($quantity > $stock_quantity) {
            echo json_encode(['status' => 'error', 'message' => 'Quantity exceeds available stock']);
            exit;
        }
        
        $stmt = $_db->prepare('UPDATE carts SET unit = ? WHERE product_id = ? AND user_id = ?');
        if ($stmt->execute([$quantity, $product_id, $user_id])) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
    }
}
?>
