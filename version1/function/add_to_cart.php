<?php
include '../_base.php';

$user = req('user');
$product = req('product');

$stm = $_db->prepare('SELECT unit FROM carts WHERE product_id = ? AND user_id = ?');
$stm->execute([$product, $user]);
$existingUnit = $stm->fetchColumn();

if ($existingUnit === false) {
    $stm = $_db->prepare('INSERT INTO carts (user_id, product_id, unit, category_id) VALUES (?, ?, ?, ?)');
    $stm->execute([$user, $product, 1, ""]);
} else {

    $stm = $_db->prepare('UPDATE carts SET unit = unit + 1 WHERE product_id = ? AND user_id = ?');
    $stm->execute([$product, $user]);
}


?>
