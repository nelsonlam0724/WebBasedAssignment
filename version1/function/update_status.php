<?php
include '../_base.php';
include '../_head.php';

if (is_post()) {

    $user_ID = $_POST['user_ID'];
    $order_ID = $_POST['order_ID'];
    $product_ID = $_POST['product_ID'];
    $status = $_POST['status'];

    $delivered = 0;
    $num = 0;
    $done = 'Delivered';

    $stm = $_db->prepare('
        UPDATE `order_details`
        SET `order_status` = ?
        WHERE order_id = ? AND product_id = ?
    ');
    $stm->execute([$status, $order_ID, $product_ID]);

    $stm = $_db->prepare('
        SELECT i.*,p.name
        FROM `order_details` AS i,product AS p
        WHERE i.product_id = p.product_id
        AND i.order_id = ?
    ');
    $stm->execute([$order_ID]);
    $arr = $stm->fetchAll();

    $stm = $_db->prepare('
        SELECT * FROM `orders`
        WHERE id = ? AND user_id = ?
    ');
    $stm->execute([$order_ID, $user_ID]);
    $order = $stm->fetch();

    if ($order->status != 'Delivered') {
        foreach ($arr as $item) {
            $num++;
            if ($item->order_status == 'Delivered') {
                $delivered++;
            }
        }

        if ($delivered == $num) {
            $stm = $_db->prepare('
            UPDATE `orders`
            SET `status` = ?
            WHERE id = ?
        ');
            $stm->execute([$done, $order_ID]);
        } else {
            $stm = $_db->prepare('
            UPDATE `orders`
            SET `status` = ?
            WHERE id = ?
        ');
            $stm->execute(['Pending', $order_ID]);
        }

        temp('info', 'Status update successfully!');
        redirect('../admin/adminUpdateStatus.php?order_ID=' . $order_ID . '&user_ID=' . $user_ID);
    }else if($order->order_status != 'Cancelled'){
        temp('info','The order that has been cancelled cannot be update!');
        redirect('../admin/adminUpdateStatus.php?order_ID=' . $order_ID . '&user_ID=' . $user_ID);
    }else if($order->order_status != 'Delivered'){
        temp('info','The order that has been delivered cannot be update!');
        redirect('../admin/adminUpdateStatus.php?order_ID=' . $order_ID . '&user_ID=' . $user_ID);
    }
}
