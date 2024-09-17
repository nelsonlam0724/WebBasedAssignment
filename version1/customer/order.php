<?php
include '../_base.php';
include '../_head.php';
include '../include/header.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];

$stm = $_db->prepare('
        SELECT * FROM orders
        WHERE user_id = ?
    ');
$stm->execute([$user->user_id]);
$arr = $stm->fetchAll();



$_title = 'Order History -' . htmlspecialchars($user->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/orders.js"></script>
    <title>Order History</title>
    
</head>

<body>
    <h1>Order</h1>

    <p>There has <?= count($arr) ?> orders(s)</p>

    <table border="1">
        <tr>
            <th></th>
            <th>Order DateTime</th>
            <th>Order Status</th>
            <th>Total Amount</th>
            <th>Total Quantity</th>
            <th></th>
        </tr>

        <?php foreach ($arr as $i => $order): ?>
            <tr>
                <th><?php echo $i + 1; ?></th>
                <td><?= $order->datetime ?></td>
                <td><?= $order->status ?></td>
                <td><?= $order->total ?></td>
                <td><?= $order->count ?></td>
                <td>
                    <button data-get="orderDetails.php?order_id=<?= $order->id ?>&user_id=<?= $order->user_id ?>">Detail</button>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>