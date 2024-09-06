<?php
include '../_base.php';
$user = req('user');
$cart = req('cart');
$stm = $_db->prepare('DELETE FROM carts WHERE id = ? AND user_id = ?');
$stm->execute([$cart, $user]);
?>