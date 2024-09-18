<?php
include '../_base.php';

$user = req('user');
$product = req('product');


$stm = $_db->prepare('SELECT unit FROM carts WHERE product_id = ? AND user_id = ?');
$stm->execute([$product, $user]);
$existingUnit = $stm->fetchColumn();

if ($existingUnit === false) {
    $cartId = generateID('carts', 'id', 'C', 4);
    $stm = $_db->prepare('INSERT INTO carts (id,user_id, product_id, unit) VALUES (?,?, ?, ?)');
    $stm->execute([$cartId,$user, $product, "1"]);
} else {

    $stm = $_db->prepare('UPDATE carts SET unit = unit + 1 WHERE product_id = ? AND user_id = ?');
    $stm->execute([$product, $user]);
}

?>