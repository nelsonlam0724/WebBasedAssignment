<?php
include '../_base.php';
include '../_head.php';
include 'sidebar.php'; 
auth('Root', 'Admin');
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

$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_ID]);
$user = $stm->fetch();

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
<div class="container">

    <form>
        <table class="order-summary">
            <tr>
                <th>Order ID</th>
                <td><?= $order->id ?></td>
                <th>User ID</th>
                <td><?= htmlspecialchars($user->user_id) ?></td>
            </tr>
            <tr>
                <th>Date</th>
                <td><?= $order->datetime ?></td>
                <th>Username</th>
                <td><?= htmlspecialchars($user->name) ?></td>
            </tr>
            <tr>
                <th>Count</th>
                <td><?= $order->count ?></td>
                <th>Email</th>
                <td><?= htmlspecialchars($user->email) ?></td>
            </tr>
            <tr>
                <th>Total</th>
                <td><?= $order->total ?></td>
                <th>Status</th>
                <td><?= htmlspecialchars($user->status) ?></td>
            </tr>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th>Photo</th>
            <td>
                <?php if ($user->photo): ?>
                    <img src="../uploads/<?= htmlspecialchars($user->photo) ?>" alt="User Photo">
                <?php else: ?>
                    No photo available
                <?php endif; ?>
            </td>
        </table>
    </form>

    <p> <?= count($arr) ?> item(s)</p>

    <table class="items-table">
        <thead>
            <tr>
                <th></th>
                <th>Product Name</th>
                <th>Price (RM)</th>
                <th>Unit</th>
                <th>Subtotal (RM)</th>
            </tr>
        </thead>
        <tbody>

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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form method="post" action="../function/update_status.php" class="status-form">
        <select name="status[<?= $item->product_id ?>]" class="status-select" onchange="document.getElementById('status_<?= $order->id ?>').value = this.value;">
            <option value="Shipped" <?= $order->status == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
            <option value="Cancelled" <?= $order->status == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
            <option value="Paid" <?= $order->status == 'Paid' ? 'selected' : '' ?>>Paid</option>
            <option value="Delivered" <?= $order->status == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
        </select>

        <input type="hidden" name="product_ID" value="<?= $order->id ?>">
        <input type="hidden" name="user_ID" value="<?= $user_ID ?>">
        <input type="hidden" id="status_<?= $order->id ?>" name="status" value="<?= $order->status ?>">
        <input type="hidden" name="num" value="<?= $num ?>">
        <input type="hidden" name="delivered" value="<?= $delivered ?>">
        <input type="submit" name="submit" value="Update" data-updatestatus>
    </form>

    <div class="action-buttons">
        <a href="orderList.php"><button>Back To Order List</button></a>
    </div>
</div>