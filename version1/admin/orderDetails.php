<?php
include '../_base.php';
include '../_head.php';
$order_ID = req('order_ID');
$user_ID = req('user_ID');

$stm = $_db->prepare('
    SELECT * FROM `orders`
    WHERE id = ? AND user_id = ?
');
$stm->execute([$order_ID, $user_ID]);
$order = $stm->fetch();


$stm = $_db->prepare('
    SELECT i.*,p.name
    FROM `order_details` AS i,product AS p
    WHERE i.product_id = p.product_id
    AND i.order_id = ?
');
$stm->execute([$order_ID]);
$arr = $stm->fetchAll();



$_title = 'Order Details';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/orders.js"></script>
    <link rel="stylesheet" href="../css/userList.css">
    <title>Order List</title>
</head>
<form>
    <label>Order Id</label>
    <div><?= $order->id ?></div>
    <br>

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

<p> <?= count($arr) ?> item(s)</p>

<table border="1">
    <tr>
        <th></th>
        <th>Product Name</th>
        <th>Price (RM)</th>
        <th>Unit</th>
        <th>Subtotal (RM)</th>
        <th>Status</th>
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
            <td><?= $item->order_status ?></td>
        </tr>
    <?php endforeach; ?>

</table>

<div class="action-buttons">
    <a href="orderList.php"><button>Back To Order List</button></a>
</div>