<?php
include '../_base.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];


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

    echo $order_ID;
    echo $user->user_id;
    echo $product_ID;

    if ($check->status == 'Delivered') {
        temp('info', 'Delivered Item cannot be cancelled!');
        redirect('../customer/information.php?tab=5&tmp=1');
    } else if ($check->status == 'Cancelled') {
        temp('info', 'Cancelled Item cannot be cancelled again!');
        redirect('../customer/information.php?tab=5&tmp=2');
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
        redirect('../customer/information.php?tab=5?&tmp=3');
    }
}
