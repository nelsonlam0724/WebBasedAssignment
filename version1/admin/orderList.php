<?php
include '../_base.php';
include '../_head.php';
require_once '../lib/SimplePager.php'; // Include SimplePager class
include '../include/sidebarAdmin.php';

auth('Root', 'Admin');

$arr = $_db->query('SELECT * FROM orders')->fetchAll();

$dispnum = isset($_GET['displ']) ? trim($_GET['displ']) : '';

// Initialize variables
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'id';
$sort_order = isset($_GET['sort_order']) ? trim($_GET['sort_order']) : 'ASC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Number of records per page

// Start constructing the query
$query = 'SELECT * FROM orders WHERE 1=1';
$params = [];

if ($search_query) {
    $query .= ' AND (id LIKE ? OR user_id LIKE ?)';
    $params[] = '%' . $search_query . '%';
    $params[] = '%' . $search_query . '%';
}

// Add status filter if provided
if ($status_filter) {
    $query .= ' AND status = ?';
    $params[] = $status_filter;
}

// Add sorting
$query .= " ORDER BY $sort_by $sort_order";

// Initialize SimplePager with the query, parameters, limit, and current page
$pager = new SimplePager($query, $params, $limit, $page);

// Get results for the current page
$orders = $pager->result;
$total_pages = $pager->page_count;

// Fetch statuses for filter options
$statuses_stm = $_db->query('SELECT DISTINCT status FROM orders');
$statuses = $statuses_stm->fetchAll(PDO::FETCH_COLUMN);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/orders.js"></script>
    <link rel="stylesheet" href="../css/orderList.css"> <!-- Link the external CSS -->
    <title>Order List</title>
    <script>
        function submitSearch() {
            document.getElementById('searchForm').submit();
        }

        function focusSearchInput() {
            const searchInput = document.getElementById('searchInput');
            searchInput.focus();
        }

        window.onload = function() {
            const searchInput = document.getElementById('searchInput');
            if ('<?= htmlspecialchars($search_query) ?>') {
                setTimeout(() => {
                    searchInput.focus();
                    searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length); // 将光标放在末尾
                }, 0);
            } else {
                searchInput.focus();
            }
        };
    </script>
</head>

<body>
    <div class="container">
        <h1>Order List</h1>

        <p>There has <?= count($arr) ?> order(s)</p>

        <!-- Search Form -->
        <form action="orderList.php" method="get" id="searchForm">
            <input type="text" id="searchInput" name="search" placeholder="Search by id" value="<?= htmlspecialchars($search_query) ?>" oninput="submitSearch()">
            <input type="hidden" name="status" value="<?= htmlspecialchars($status_filter) ?>">
            <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
            <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>">
            <input type="hidden" name="page" value="1"> <!-- Always start at page 1 for new searches -->
        </form>

        <!-- Filter and Sorting Options -->
        <div class="filter-sorting">
            <form action="orderList.php" method="get">
                <input type="hidden" name="page" value="1">

                <!-- Status Filter -->
                <label for="status">Status:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?= htmlspecialchars($status) ?>" <?= $status == $status_filter ? 'selected' : '' ?>>
                            <?= htmlspecialchars($status) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <!-- Sorting Options -->
                <label for="sort_by">Sort by:</label>
                <select name="sort_by" id="sort_by" onchange="this.form.submit()">
                    <option value="id" <?= $sort_by == 'id' ? 'selected' : '' ?>>ID</option>
                    <option value="user_id" <?= $sort_by == 'user_id' ? 'selected' : '' ?>>User ID</option>
                    <option value="total" <?= $sort_by == 'total' ? 'selected' : '' ?>>Total Amount</option>
                    <option value="count" <?= $sort_by == 'count' ? 'selected' : '' ?>>Count</option>
                    <option value="status" <?= $sort_by == 'status' ? 'selected' : '' ?>>Status</option>
                </select>
                <label for="sort_order">Order:</label>
                <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                    <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                    <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                </select>
            </form>
        </div>

        <!-- Order Table -->
        <table class="order-table">
            <tr>
                <th></th>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Total Amount</th>
                <th>Count</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($orders as $i => $order): ?>
                <tr>
                    <td><?= ++$dispnum ?></td>
                    <td><?= $order->id ?></td>
                    <td data-get="userDetails.php?user_id=<?= $order->user_id ?>"><?= $order->user_id ?></td>
                    <td><?= $order->datetime ?></td>
                    <td><?= $order->status ?></td>
                    <td><?= $order->total ?></td>
                    <td><?= $order->count ?></td>
                    <td>
                        <button data-get="orderDetails.php?order_ID=<?= $order->id ?>&user_ID=<?= $order->user_id ?>">Detail</button>
                        <button data-get="adminUpdateStatus.php?order_ID=<?= $order->id ?>&user_ID=<?= $order->user_id ?>">Update Status</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- Pagination Links -->
        <div class="pagination">
            <!-- Previous Page Link -->
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&displ=<?= ($page == 1) ? $page : ($page - 2) * 10 ?>">Previous</a>
            <?php endif; ?>


            <!-- Page Numbers -->
            <?php
            $page_range = 2; // Number of pages to show before and after the current page
            $start_page = max(1, $page - $page_range);
            $end_page = min($total_pages, $page + $page_range);


            if ($start_page > 1): ?>
                <a href="?page=1&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">1</a>
                <?php if ($start_page > 2): ?>
                    <span>...</span>
                <?php endif; ?>
            <?php endif; ?>


            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&displ=<?= ($i == 1) ? $i - 1 : ($i - 1) * 10 ?>" class="<?= $i == $page ? 'current-page' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>


            <?php if ($end_page < $total_pages): ?>
                <?php if ($end_page < $total_pages - 1): ?>
                    <span>...</span>
                <?php endif; ?>
                <a href="?page=<?= $total_pages ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&displ=<?= ($page == 1) ? $page : ($page - 1) * 10 ?>">
                    <?= $total_pages ?>
                </a>
            <?php endif; ?>


            <!-- Next Page Link -->
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&displ=<?= ($page == 1) ? $page * 10 : ($page) * 10 ?>">Next</a>
            <?php endif; ?>

        </div>
        <div class="action-buttons">
            <a href="admin.php"><button>Back To Menu</button></a>
            <a href="generateReport.php"><button>Generate Summary Seport</button></a>
        </div>
    </div>
</body>

</html>