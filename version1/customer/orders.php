<?php
include '../_base.php';
include '../include/header.php';
include '../_head.php';
include '../include/sidebar.php';

auth('Member');
// Fetch user profile information
$user = $_SESSION['user'];


$getPending = $_db->prepare('
    SELECT * FROM `orders` 
    WHERE user_id = ? AND status = ?
    ORDER BY id DESC
');


$getPending->execute([$userID, "Pending"]);
$results = $getPending->fetchAll();

$stm = $_db->prepare('
                SELECT * FROM orders
                WHERE user_id = ?
            ');
$stm->execute([$user->user_id]);
$arr = $stm->fetchAll();


$disp = 0;

require_once '../lib/SimplePager.php'; // Include SimplePager class


// Initialize variables
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'id';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Number of records per page

// Start constructing the query
$query = 'SELECT * FROM orders WHERE 1=1';
$params = [];

// Add status filter if provided
if ($status_filter) {
    $query .= ' AND status = ?';
    $params[] = $status_filter;
}

// Add sorting
$query .= " ORDER BY $sort_by";

// Initialize SimplePager with the query, parameters, limit, and current page
$pager = new SimplePager($query, $params, $limit, $page);

// Get results for the current page
$orders = $pager->result;
$total_pages = $pager->page_count;

// Fetch statuses for filter options
$statuses_stm = $_db->query('SELECT DISTINCT status FROM orders');
$statuses = $statuses_stm->fetchAll(PDO::FETCH_COLUMN);

?>

<link rel="stylesheet" href="../css/orderItem.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/orders.js"></script>
</head>
<br><br><br><br><br><br><br><br>
<div class="container">
<h1>Order</h1>

<p class="order-count">There has <?= count($arr) ?> orders(s)</p>

<!-- Filter and Sorting Options -->
<div class="filter-sorting">
    <form action="orders.php" method="get">
        <input type="hidden" name="page" value="1">

        <!-- Status Filter -->
        <label for="status">Status:</label>
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="">All Status</option>
            <?php foreach ($statuses as $status): ?>
                <?php if ($status != 'Pending' && $status != ''): ?>
                    <option value="<?= htmlspecialchars($status) ?>" <?= $status == $status_filter ? 'selected' : '' ?>>
                        <?= htmlspecialchars($status) ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <!-- Sorting Options -->
        <label for="sort_by">Sort by:</label>
        <select name="sort_by" id="sort_by" onchange="this.form.submit()">
            <option value="status" <?= $sort_by == 'status' ? 'selected' : '' ?>>Status</option>
            <option value="total" <?= $sort_by == 'total' ? 'selected' : '' ?>>Total Amount</option>
            <option value="count" <?= $sort_by == 'count' ? 'selected' : '' ?>>Count</option>
        </select>
        <input type="hidden" id="tab" name="tab" value="5">
    </form>
</div>
<div class="order-grid">
    <?php foreach ($orders as $i => $order): ?>
        <?php if ($order->status != 'Pending' && $order->status != ''): ?>
            <?php
            // Fetch order details and related product names
            $stm = $_db->prepare('
                SELECT i.*, p.name
                FROM `order_details` AS i, product AS p
                WHERE i.product_id = p.product_id
                AND i.order_id = ?
            ');
            $stm->execute([$order->id]);
            $order_details = $stm->fetchAll();
            ?>

            <!-- Order Card -->
            <div class="order-card">
                <div class="order-info">
                    <p><strong>Order <?= ++$disp ?></strong></p>
                    <p><strong>Date:</strong> <?= $order->datetime ?></p>
                    <p><strong>Status:</strong> <?= $order->status ?></p>
                    <p><strong>Total Amount:</strong> RM <?= $order->total ?></p>

                    <form method="post" action="../function/cancel_order.php">
                        <input type="hidden" name="order_ID" value="<?= $order->id ?>">
                        <input type="hidden" name="user_ID" value="<?= $order->user_id ?>">
                        <input type="hidden" name="product_ID" value="<?= $order->product_id ?>">
                        <input type="submit" name="submit" value="Cancel Order" class="cancel-button" data-order>
                    </form>
                </div>

                <div class="product-info">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price (RM)</th>
                                <th>Unit</th>
                                <th>Subtotal (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $item): ?>
                                <tr>
                                    <td><?= $item->name ?></td>
                                    <td><?= $item->price ?></td>
                                    <td><?= $item->unit ?></td>
                                    <td><?= $item->subtotal ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>


<!-- Pagination Links -->
<div class="pagination">
    <!-- Previous Page Link -->
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&status=<?= urlencode($status_filter) ?>&tab=5">Previous</a>
    <?php endif; ?>


    <!-- Page Numbers -->
    <?php
    $page_range = 2; // Number of pages to show before and after the current page
    $start_page = max(1, $page - $page_range);
    $end_page = min($total_pages, $page + $page_range);


    if ($start_page > 1): ?>
        <a href="?page=1&sort_by=<?= urlencode($sort_by) ?>&tab=5&status=<?= urlencode($status_filter) ?>">1</a>
        <?php if ($start_page > 2): ?>
            <span>...</span>
        <?php endif; ?>
    <?php endif; ?>


    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
        <a href="?page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&tab=5&status=<?= urlencode($status_filter) ?>" class="<?= $i == $page ? 'current-page' : '' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>


    <?php if ($end_page < $total_pages): ?>
        <?php if ($end_page < $total_pages - 1): ?>
            <span>...</span>
        <?php endif; ?>
        <a href="?page=<?= $total_pages ?>&sort_by=<?= urlencode($sort_by) ?>&tab=5&status=<?= urlencode($status_filter) ?>">
            <?= $total_pages ?>
        </a>
    <?php endif; ?>


    <!-- Next Page Link -->
    <?php if ($page < $total_pages): ?>
        <a href="?page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&tab=5&status=<?= urlencode($status_filter) ?>">Next</a>
    <?php endif; ?>
</div>
</div>
</body>

</html>