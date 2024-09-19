<?php
include '../_base.php';
require_once '../lib/SimplePager.php';

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'product_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$category_filter = isset($_GET['category']) ? $_GET['category'] : ''; // Category filter
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$limit = 5;

// Select product with category name using LEFT JOIN
$sql = 'SELECT p.*, c.category_name FROM product p
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

    <!-- Success/Error Messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
    <div class="success-message">
        <?= htmlspecialchars($_SESSION['success_message']); ?>
        <?php unset($_SESSION['success_message']); ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="error-message">
            <?= htmlspecialchars($_SESSION['error_message']); ?>
            <?php unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>

    <!-- Search Form -->
    <form action="productList.php" method="get" class="search-form">
        <input type="text" name="search" placeholder="Search" value="<?= htmlspecialchars($search_query) ?>">
        <input type="hidden" name="sort_by" value="<?= htmlspecialchars($category_filter) ?>">
        <input type="hidden" name="sort_order" value="<?= htmlspecialchars($status_filter) ?>">
        <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
        <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>">
        <input type="hidden" name="page" value="1">
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
        <form method="post" action="deleteProduct.php">
            <?php if ($product): ?>
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($product as $p): ?>
                            <tr>
                                <td><input type="checkbox" name="product_ids[]" value="<?= $p->product_id ?>" class="product-checkbox"></td> <!-- Product Checkbox -->
                                <td><?= htmlspecialchars($p->product_id) ?></td>
                                <td><?= htmlspecialchars($p->name) ?></td>
                                <td><?= htmlspecialchars($p->category_name) ?></td>
                                <td class="actions">
                                    <a href="productEdit.php?product_id=<?= $p->product_id ?>" class="edit-container">
                                        <button type="button">Edit Details</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="action-buttons">
                    <button type="submit" id="delete-selected" onclick="return confirm('Are you sure you want to deactivate the selected products?');">Deactivate</button>
                </div>

                <div class="pagination-container">
                    <!-- Previous Button -->
                    <?php if ($page > 1): ?>
                        <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&category=<?= urlencode($category_filter) ?>&status=<?= urlencode($status_filter) ?>" class="pagination-button">Previous</a>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php if ($i == $page): ?>
                            <span class="current-page"><?= $i ?></span>
                        <?php else: ?>
                            <a href="?search=<?= urlencode($search_query) ?>&page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&category=<?= urlencode($category_filter) ?>&status=<?= urlencode($status_filter) ?>" class="pagination-button"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <?php if ($page < $total_pages): ?>
                        <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&category=<?= urlencode($category_filter) ?>&status=<?= urlencode($status_filter) ?>" class="pagination-button">Next</a>
                    <?php endif; ?>

                </div>
            <?php else: ?>
                <p class="no-results">No products found.</p>
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

<?php
include '../_foot.php';
