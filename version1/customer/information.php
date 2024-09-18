<?php
include '../_base.php';
include '../include/header.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];


$getPending = $_db->prepare('
    SELECT * FROM `orders` 
    WHERE user_id = ? AND status = ?
    ORDER BY id DESC
');


$getPending->execute([$userID, "Pending"]);
$results = $getPending->fetchAll();

?>

<link rel="stylesheet" href="../css/information.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/orders.js"></script>
</head>

<body>


    <div class="tabs">
        <label class="label" onclick="back()"><i class="fa fa-angle-double-left" style="color:white"></i>Back</label>
        <input class="input" name="tabs" type="radio" id="tab-1" checked="checked" />
        <label class="label" for="tab-1">To Pay</label>
        <div class="panel">

            <?php
            $current_time = time();
            $stm = $_db->prepare("SELECT id FROM orders WHERE status = 'Pending' AND created_at < NOW() - INTERVAL 1 MINUTE");
            $stm->execute();
            $orderss = $stm->fetchAll(PDO::FETCH_ASSOC);

            foreach ($orderss as $order) {
                $stm = $_db->prepare("UPDATE orders SET status = 'Cancel' WHERE id = :id");
                $stm->bindParam(':id', $order['id']);
                $stm->execute();
            }

            $count = 0;
            foreach ($results as $o): ?>
                <div class="item-container">
                    <div class="item-details">
                        <div class="item-text">
                            <h2><?= $count + 1 ?>.Order ID : <?= $o->id ?></h2>
                            <p>Total amount : RM <?= $o->total ?></p>
                            <p>Date order : <?= $o->datetime ?></p>
                            <a href="details.php?ship_id=<?= $o->ship_id ?>&order_id=<?= $o->id ?>"><button class="check-button">Check</button></a>
                        </div>
                    </div>

                </div>
            <?php $count++;
            endforeach ?>


        </div>



        <input class="input" name="tabs" type="radio" id="tab-3" />
        <label class="label" for="tab-3">Shipping details</label>
        <div class="panel">
            <?php



            $getPending = $_db->prepare('
                SELECT * FROM `orders` WHERE user_id = ? AND status = ?
            ');

            $getPending->execute([$userID, "Pending"]);
            $results = $getPending->fetchAll();



            ?>




            <div class="product-container" style="padding:28px">
                <div class="product-details">
                    <div class="product-title"><%= r %>. Shipping ID : <%= ship[0] %></div>
                    <div class="product-description">Item will be arrived within <i style="color:green;text-decoration:underline;"> <%= ship[5] %></i> </div>
                    <div class="product-description">Address : <%= ship[4] %></div>
                    <div class="product-description">Recipient name : <%= ship[6] %></div>
                    <div class="product-description">Status : <%= ship[3] %></div>
                    <div class="product-description">Company : <%= ship[1] %></div>
                    <div class="product-description" style="color:rgb(77, 130, 24)">Fee:RM <%= ship[5] %></div>
                    <button class="rate-button" onclick="view_detail('<%= ship[0] %>', '<%= ship[5] %>')">View detail</button>
                </div>

            </div>


        </div>

        <input class="input" name="tabs" type="radio" id="tab-4" />
        <label class="label" for="tab-4">To Rate</label>
        <div class="panel">

            <?php



            $getPaid = $_db->prepare('
               SELECT od.* ,o.* , p.product_id , p.name AS product_name ,od.price AS odPrice
               FROM order_details AS od 
               JOIN orders AS o ON od.order_id = o.id
               JOIN product AS p ON od.product_id = p.product_id
               WHERE o.status = ? AND o.user_id = ?
               ');

            $getPaid->execute(["Paid", $userID]);
            $results = $getPaid->fetchAll();



            ?>

            <?php $count = 0;
            foreach ($results as $o): ?>
                <div class="item-container">

                    <div class="item-details">
                        <img src="<?= $o->photo ?>" alt="" class="item-image" width="100" height="100">
                        <div class="item-text">
                            <h2>Product ID :<?= $o->product_id ?></h2>
                            <h3><?= $o->product_name  ?></h3>
                            <h3>unit : <?= $o->unit ?></h3>
                            <h3>price : <?= $o->odPrice ?></h3>
                            <p style="color:orangered">Subtotal :RM <?= $o->subtotal ?></p>
                        </div>

                    </div>

                    <a href="comment.php?id=<?= $o->product_id ?>"><button class="rate-button" style="width:150px">Rate</button></a>
                </div>
            <?php endforeach; ?>

        </div>

        <input class="input" name="tabs" type="radio" id="tab-5" <?= isset($_GET['tab']) && $_GET['tab'] == '5' ? 'checked' : '' ?> />
        <label class="label" for="tab-5" id="tab-label-5">Order</label>
        <div class="panel">
            <?php
            $stm = $_db->prepare('
                SELECT * FROM orders
                WHERE user_id = ?
            ');
            $stm->execute([$user->user_id]);
            $arr = $stm->fetchAll();

            require_once '../lib/SimplePager.php'; // Include SimplePager class


            // Initialize variables
            $status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
            $sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'id';
            $sort_order = isset($_GET['sort_order']) ? trim($_GET['sort_order']) : 'ASC';
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 10; // Number of records per page

            // Start constructing the query
            $query = 'SELECT * FROM orders WHERE 1=1';
            $params = [];

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

            <h1>Order</h1>

            <p class="order-count">There has <?= count($arr) ?> orders(s)</p>

            <!-- Filter and Sorting Options -->
            <div class="filter-sorting">
                <form action="information.php" method="get">
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
                        <option value="status" <?= $sort_by == 'status' ? 'selected' : '' ?>>Status</option>
                        <option value="total" <?= $sort_by == 'total' ? 'selected' : '' ?>>Total Amount</option>
                        <option value="count" <?= $sort_by == 'count' ? 'selected' : '' ?>>Count</option>
                    </select>
                    <label for="sort_order">Order:</label>
                    <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                        <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                        <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                    </select>
                    <input type="hidden" id="tab" name="tab" value="5">
                </form>
            </div>
            <table class="order-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Order DateTime</th>
                        <th>Order Status</th>
                        <th>Total Amount</th>
                        <th>Total Quantity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $i => $order): ?>
                        <tr>
                            <th><?php echo $i + 1; ?></th>
                            <td><?= $order->datetime ?></td>
                            <td><?= $order->status ?></td>
                            <td><?= $order->total ?></td>
                            <td><?= $order->count ?></td>
                            <td>
                                <button data-get="orderDetails.php?order_id=<?= $order->id ?>&user_id=<?= $order->user_id ?>" class="details-button">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="pagination">
                <!-- Previous Page Link -->
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">Previous</a>
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
                    <a href="?page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>" class="<?= $i == $page ? 'current-page' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>


                <?php if ($end_page < $total_pages): ?>
                    <?php if ($end_page < $total_pages - 1): ?>
                        <span>...</span>
                    <?php endif; ?>
                    <a href="?page=<?= $total_pages ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">
                        <?= $total_pages ?>
                    </a>
                <?php endif; ?>


                <!-- Next Page Link -->
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">Next</a>
                <?php endif; ?>

            </div>



        </div>

    </div>


</body>
<script>


</script>

</html>