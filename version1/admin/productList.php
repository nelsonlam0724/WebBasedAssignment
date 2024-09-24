<?php
include '../_base.php';
require_once '../lib/SimplePager.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'product_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$category_filter = isset($_GET['category']) ? $_GET['category'] : ''; // Category filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$limit = 5;
$min_stock = 1; // Minimum stock threshold

// Select product with category name and check for low stock using LEFT JOIN
$sql = 'SELECT p.* FROM product p
LEFT JOIN category c ON p.category_id = c.category_id WHERE 1=1';
$params = [];

if ($search_query) {
    $sql .= ' AND (p.name LIKE ? OR p.description LIKE ?)';
    $params[] = '%' . $search_query . '%';
    $params[] = '%' . $search_query . '%';
}

if ($category_filter) {
    $sql .= ' AND p.category_id = ?';
    $params[] = $category_filter;
}

if ($status_filter) {
    $sql .= ' AND p.status LIKE ?';
    $params[] = $status_filter;
}

$sql .= " ORDER BY p.$sort_by $sort_order";

$pager = new SimplePager($sql, $params, $limit, $page);
$product = $pager->result;
$total_pages = $pager->page_count;

$categories_stm = $_db->query('SELECT DISTINCT category_id, category_name FROM category');
$categories = $categories_stm->fetchAll(PDO::FETCH_KEY_PAIR);

$status_stm = $_db->query('SELECT DISTINCT status FROM product');
$statuses = $status_stm->fetchAll(PDO::FETCH_COLUMN);

$_title = 'Product List';
include '../_head.php';
?>

<link rel="stylesheet" href="../css/product.css">

<div class="container">
    <h1>Product List</h1>

    <!-- Search Form -->
    <form action="productList.php" method="get" class="search-form">
        <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($search_query) ?>">
        <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
        <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>">
        <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
        <button type="submit" class="form-button">Search</button>
    </form>

    <!-- Filter and Sorting Options -->
    <div class="filter-sorting">
        <form action="productList.php" method="get" class="filter-form">
            <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
            <input type="hidden" name="page" value="1">

            <!-- Category Filter -->
            <label for="category">Category:</label>
            <select name="category" id="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php foreach ($categories as $category_id => $category_name): ?>
                    <option value="<?= $category_id ?>" <?= $category_id == $category_filter ? 'selected' : '' ?>>
                        <?= htmlspecialchars($category_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>

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
                <option value="product_id" <?= $sort_by == 'product_id' ? 'selected' : '' ?>>ID</option>
                <option value="name" <?= $sort_by == 'name' ? 'selected' : '' ?>>Name</option>
                <option value="category_id" <?= $sort_by == 'category_id' ? 'selected' : '' ?>>Category</option>
            </select>

            <!-- Sort Order Options -->
            <label for="sort_order">Order:</label>
            <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
            </select>
        </form>
    </div>

    <div class="table-wrapper">
        <!-- Product Table with Checkboxes -->
        <form method="post" action="deactivateProduct.php" onsubmit="return checkSelection(this);">
            <?php if ($product): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th> <!-- Added Quantity column -->
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product as $p):
                            $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
                            $getProductImg->execute([$p->product_id]);
                            $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
                            $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="product_ids[]" value="<?= $p->product_id ?>" class="product-checkbox">
                                </td>
                                <td><?= htmlspecialchars($p->product_id) ?></td>
                                <td>
                                    <div class="hover-container">
                                        <?= htmlspecialchars($p->name) ?>
                                        <div class="hover-popup">
                                            <?php foreach ($productImg as $image): ?>
                                                <img src="../uploads/<?= htmlspecialchars($image) ?>" alt="Product Image" class="popup-image">
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="<?= $p->quantity <= $min_stock ? 'low-stock' : '' ?>">
                                    <?= htmlspecialchars($p->quantity) ?>
                                    <?php if ($p->quantity <= $min_stock): ?>
                                        <span class="low-stock-alert">Low Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($p->status) ?></td>
                                <td class="actions">
                                    <!-- Product Edit Action -->
                                    <a href="productEdit.php?product_id=<?= $p->product_id ?>" class="edit-container">
                                        <button type="button" class="edit-button">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <div class="action-buttons">
                    <button type="submit" formaction="deactivateProduct.php" id="deactivate-selected" onclick="return confirm('Are you sure you want to deactivate the selected products?');">Deactivate</button>
                    <button type="submit" formaction="activateProduct.php" id="activate-selected" onclick="return confirm('Are you sure you want to activate the selected products?');">Activate</button>
                </div>

                 <!-- Pagination Links -->
            <div class="pagination">
                <!-- First Page Link -->
                <?php if ($page > 1): ?>
                    <a href="?page=1&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">First</a>
                <?php endif; ?>

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

                <!-- Last Page Link -->
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $total_pages ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">Last</a>
                <?php endif; ?>
            </div>

            <?php else: ?>
                <p class="no-results">No active products available for deactivation.</p>
            <?php endif; ?>
        </form>

        <!-- "Add New Product" and "Back to Menu" Buttons -->
        <div class="action-buttons">
            <a href="newProduct.php"><button type="button" id="add-new">Add New Product</button></a>
            <a href="admin.php"><button type="button" id="back-to-menu">Back To Menu</button></a>
        </div>
    </div>
</div>

<script src="../js/productList.js"></script>