<?php
require '../_base.php';

if (is_post()) {

    $user = req('user');
    $product = req('product');
   
    try {
        $check = $_db->prepare('SELECT * FROM favorite WHERE product_id = ? AND user_id = ?');
        $check->execute([$product, $user]);
        $exists = $check->fetchColumn() > 0;

        if (!$exists) {
            $stm = $_db->prepare('INSERT INTO favorite (product_id, user_id) VALUES (?, ?)');
            $stm->execute([$product, $user]);
            echo json_encode(1); 
        } else {
            $stm = $_db->prepare('DELETE FROM favorite WHERE product_id = ? AND user_id = ?');
            $stm->execute([$product, $user]);
            echo json_encode(0); 
        }
       
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
}

?>


