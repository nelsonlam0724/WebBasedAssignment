<?php
include '../_base.php';
include '../_head.php';

auth('Root', 'Admin');
// Fetch user profile information
$user = $_SESSION['user'];

$arr = $_db->query('SELECT * FROM orders')->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/orders.js"></script>
    <link rel="stylesheet" href="../css/userList.css">
    <title>Order List</title>
</head>

<body>
    <h1>Order List</h1>

    <p>There has <?= count($arr) ?> orders(s)</p>

    <!-- Search Form -->
    <form action="orderList.php" method="get">
        <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>">
        <!-- <input type="hidden" name="role" value="<?= htmlspecialchars($role_filter) ?>">
        <input type="hidden" name="status" value="<?= htmlspecialchars($status_filter) ?>">
        <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
        <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>"> -->
        <input type="hidden" name="page" value="1"> <!-- Always start at page 1 for new searches -->
        <button type="submit" class="form-button">Search</button>
    </form>

    <table border="1">
        <tr>
            <th></th>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Total Amount</th>
            <th>Count</th>
            <th></th>
        </tr>
        <?php foreach ($arr as $i => $order): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $order->id ?></td>
                <td data-get="userDetails.php?user_id=<?= $order->user_id ?>"><?= $order->user_id ?></td>
                <td><?= $order->datetime ?></td>
                <td><?= $order->status ?></td>
                <td><?= $order->total ?></td>
                <td><?= $order->count ?></td>
                <td>
                    <button data-get="orderDetails.php?order_ID=<?= $order->id ?>&user_ID=7">Detail</button>
                    <?php if ($order->status != 'Delivered' && $order->status != 'Cancelled'): ?>
                        <button data-get="adminUpdateStatus.php?order_ID=<?= $order->id ?>&customer_ID=<?= $order->user_id ?>">Update Status</button>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </table>

    <div class="action-buttons">
        <a href="admin.php"><button>Back To Menu</button></a>
    </div>
</body>