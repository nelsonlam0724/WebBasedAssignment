<?php
include '../_base.php';

if (is_post()) {

    $user = req('user');
    $pro = req('pro');
   
    $stm = $_db->prepare('DELETE FROM favorite WHERE product_id = ? AND user_id = ?');
    $stm->execute([$pro, $user]);
}

?>


