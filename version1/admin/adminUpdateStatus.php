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
        <th></th>
    </tr>


    <?php
    $shipped = 0;
    $delivered = 0;
    $num = count($arr);
    foreach ($arr as $i => $item):
    ?>
        <tr>
            <td><?php echo $i + 1 ?></td>
            <td><?= $item->name ?></td>
            <td><?= $item->price ?></td>
            <td><?= $item->unit ?></td>
            <td><?= $item->subtotal ?></td>
            <td>
                <select name="status[<?= $item->product_id ?>]" onchange="document.getElementById('status_<?= $item->product_id ?>').value = this.value;">
                    <option value="Pending" <?= $item->order_status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Shipped" <?= $item->order_status == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                    <option value="Delivered" <?= $item->order_status == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                </select>
                <form method="post" action="../function/update_status.php">
                    <input type="hidden" name="product_ID" value="<?= $item->product_id ?>">
                    <input type="hidden" name="order_ID" value="<?= $item->order_id ?>">
                    <input type="hidden" name="user_ID" value="<?= $user_ID ?>">
                    <input type="hidden" id="status_<?= $item->product_id ?>" name="status" value="<?= $item->order_status ?>">
                    <input type="hidden" name="num" value="<?= $num ?>">
                    <input type="hidden" name="delivered" value="<?= $delivered ?>">
                    <input type="submit" name="submit" value="Update" data-updatestatus>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<div class="action-buttons">
    <a href="orderList.php"><button>Back To Order List</button></a>
</div>