<?php
include '../_base.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];


if (is_post()) {
    $email = $user->email;
    $subject = 'Order';
    $body = 'Order Canceled successfully! Your refund will be process in 3~5 working days.';

    $order_ID = $_POST['order_ID'];
    $product_ID = $_POST['product_ID'];


    $stm = $_db->prepare('
        SELECT o.status , s.status AS ship_status
        FROM `orders` AS o
        JOIN `shippers` AS s ON o.ship_id = s.ship_id
        WHERE o.id = ?
       AND o.user_id = ?
    ');
    $stm->execute([$order_ID, $user->user_id]);
    $check = $stm->fetch();

    echo $order_ID;
    echo $user->user_id;
    echo $product_ID;

    if ($check->ship_status == 'Delivered') {
        temp('info', 'Delivered Item cannot be cancelled!');
        redirect('../customer/orders.php');
    } else if ($check->status == 'Cancelled') {
        temp('info', 'Cancelled Item cannot be cancelled again!');
        redirect('../customer/orders.php');
    } else if ($check->ship_status == 'Arrive') {
        temp('info', 'Arrived Item cannot be cancelled again!');
        redirect('../customer/orders.php');
    } else {

        $stm = $_db->prepare('
            UPDATE `orders`
            SET status = ?
            WHERE id = ? AND user_id = ?
        ');
        $stm->execute(['Cancelled', $order_ID, $user->user_id]);

        ////////////////////////////////////ADD STOCK//////////////////////////////////////////////////
        $add = $_db->prepare('
            SELECT o.* , p.name , p.product_id
            FROM order_details AS o 
           JOIN product AS p ON o.product_id = p.product_id
           WHERE o.order_id = ?
');

        $items_order = [];
        $add->execute([$order_ID]);
        $addStock = $add->fetchAll(PDO::FETCH_ASSOC);

        foreach ($addStock as $o) {
            $items_order[$o['product_id']] = $o['unit'];
        }

        foreach ($items_order as $product_id => $unit) {
            $stmt = $_db->prepare('SELECT quantity FROM product WHERE product_id = ?');
            $stmt->execute([$product_id]);
            $productStock = $stmt->fetch();
            $stmt = $_db->prepare('UPDATE product SET quantity = ? WHERE product_id = ?');
            $stmt->execute([$productStock->quantity + $unit, $product_id]);
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////


        $m = get_mail();
        $m->addAddress($email);
        $m->Subject = $subject;
        $m->Body = $body;
        $m->send();

        temp('info', 'Order cancelled successfully!');
        redirect('../customer/orders.php');
    }
}
