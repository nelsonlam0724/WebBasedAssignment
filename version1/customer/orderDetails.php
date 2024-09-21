<?php
include '../_base.php';
include '../_head.php';
include '../include/header.php';
include '../include/sidebar.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];
$order_ID = req('order_id');
$user_ID = req('user_id');



$_title = 'Order Details -' . htmlspecialchars($user->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/orders.js"></script>
    <link rel="stylesheet" href="../css/orderItem.css">
    <title>Order Items</title>
</head>
<br><br><br><br><br><br><br><br>

<body>
    <h1>Order Details</h1>
    <form class="order-summary">

        <label>Date</label>
        <div><?= $order->datetime ?></div>
        <br>

        <label>Count</label>
        <div><?= $order->count ?></div>
        <br>

        <label>Total</label>
        <div><?= $order->total ?></div>
        <br>
    </form>

    <p class="item-count"> <?= count($arr) ?> item(s)</p>

    <table class="order-items">
        <tr>
            <th></th>
            <th>Product Name</th>
            <th>Price (RM)</th>
            <th>Unit</th>
            <th>Subtotal (RM)</th>
        </tr>


        <?php
        $num = count($arr);
        foreach ($arr as $i => $item):
        ?>
            <tr>
                <td><?php echo $i + 1 ?></td>
                <td><?= $item->name ?></td>
                <td><?= $item->price ?></td>
                <td><?= $item->unit ?></td>
                <td><?= $item->subtotal ?></td>
            </tr>
        <?php endforeach; ?>

    </table>
    

    <button class="back-button" onclick="location.href='information.php?tab=5'">Back</button>
</body>

</html>