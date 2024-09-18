<?php
include '../_base.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];


$cancel = 0;
$num = 0;



if (is_post()) {
    // $email = $user->email;
    // $subject = 'Order';
    // $body = 'Order Canceled successfully! Your refund will be process in 3~5 working days.';

    $order_ID = $_POST['order_ID'];
    $product_ID = $_POST['product_ID'];


    $stm = $_db->prepare('
    SELECT status
    FROM `orders` 
    WHERE id = ?
    AND user_id = ?
    ');
    $stm->execute([$order_ID, $user->user_id]);
    $check = $stm->fetch();

    if ($check->status == 'Delivered') {
        temp('info', 'Delivered Item cannot be cancelled!');
        redirect('../customer/orderDetails.php?order_id=' . $order_ID . '&user_id=' . $user->user_id);
    }else if($check->status == 'Cancelled'){
        temp('info', 'Delivered Item cannot be cancelled again!');
        redirect('../customer/orderDetails.php?order_id=' . $order_ID . '&user_id=' . $user->user_id);
    } else {

            $stm = $_db->prepare('
            UPDATE `orders`
            SET status = ?
            WHERE id = ? AND user_id = ?
        ');
            $stm->execute(['Cancelled', $order_ID, $user->user_id]);
        


        // $m = get_mail();
        // $m->addAddress($email);
        // $m->Subject = $subject;
        // $m->Body = $body;
        // $m->send();

        temp('info', 'Order cancelled successfully!');
        redirect('../customer/orderDetails.php?order_id=' . $order_ID . '&user_id=' . $user->user_id);
    }
}
