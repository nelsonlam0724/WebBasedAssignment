<?php
include '../_base.php';

$user = req('user');
$product = req('product');

$stm = $_db->prepare('SELECT unit FROM carts WHERE product_id = ? AND user_id = ?');
$stm->execute([$product, $user]);
$existingUnit = $stm->fetchColumn();


$stmt = $_db->prepare('SELECT quantity FROM product WHERE product_id = ?');
$stmt->execute([$product]);
$productInfo = $stmt->fetch(PDO::FETCH_OBJ); 

if ($productInfo === false) {
    echo json_encode(['status' => 'error', 'message' => 'Product not found.']);
    exit();
}

$stock_quantity = $productInfo->quantity;

if ($existingUnit !== false && ($existingUnit + 1) > $stock_quantity) {
    echo json_encode(['status' => 'error', 'message' => 'Quantity exceeds available stock.']);
    exit();
}

if ($existingUnit === false) {
    $cartId = generateID('carts', 'id', 'C', 4);
    $stm = $_db->prepare('INSERT INTO carts (id, user_id, product_id, unit) VALUES (?, ?, ?, ?)');
    $stm->execute([$cartId, $user, $product, 1]);
} else {
    $stm = $_db->prepare('UPDATE carts SET unit = unit + 1 WHERE product_id = ? AND user_id = ?');
    $stm->execute([$product, $user]);
}

echo json_encode(['status' => 'success', 'message' => 'Cart updated successfully.']);
?>
