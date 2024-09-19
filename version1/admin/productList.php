<?php
include '../_base.php';
auth('Root', 'Admin');

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'product_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$category_filter = isset($_GET['category']) ? $_GET['category'] : ''; // Category filter

// Select product with category name using LEFT JOIN
$sql = 'SELECT p.*, c.category_name FROM product p
LEFT JOIN category c ON p.category_id = c.category_id WHERE 1';
$params = [];

if ($search_query) {
    $sql .= ' AND (p.name LIKE ? OR p.description LIKE ?)';
    $params[] = '%' . $search_query . '%';
    $params[] = '%' . $search_query . '%';
}

// Correctly reference the category_id from the product table
if ($category_filter) {
    $sql .= ' AND p.category_id = ?';
    $params[] = $category_filter;
}

// Count query should also use the correct reference for category_id
$count_sql = 'SELECT COUNT(*) FROM product p WHERE 1';
if ($search_query) {
    $count_sql .= ' AND (p.name LIKE ? OR p.description LIKE ?)';
}
if ($category_filter) {
    $count_sql .= ' AND p.category_id = ?';
}
$count_stm = $_db->prepare($count_sql);
$count_stm->execute($params);
$total_records = $count_stm->fetchColumn();
$total_pages = ceil($total_records / $records_per_page);

$sql .= ' ORDER BY ' . $sort_by . ' ' . $sort_order;
$sql .= ' LIMIT ' . $records_per_page . ' OFFSET ' . $offset;
$stm = $_db->prepare($sql);
$stm->execute($params);
$product = $stm->fetchAll(PDO::FETCH_OBJ);
$categories_stm = $_db->query('SELECT DISTINCT category_id, category_name FROM category');
$categories = $categories_stm->fetchAll(PDO::FETCH_KEY_PAIR);

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
        <input type="text" name="search" placeholder="Search by product name" value="<?= htmlspecialchars($search_query) ?>">
        <button type="submit" class="form-button">Search</button>
    </form>


    <!-- Filter and Sorting Options -->
    <div class="filter-sorting">
        <form action="productList.php" method="get" class="filter-form">
            <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
            <input type="hidden" name="page" value="<?= $page ?>">

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
        <form method="post" action="deleteProducts.php">
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
                    <button type="submit" id="delete-selected" onclick="return confirm('Are you sure you want to delete the selected products?');">Delete Selected</button>
                </div>

                <div class="pagination-container">
                    <!-- Previous Button -->
                    <?php if ($page > 1): ?>
                        <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&category=<?= urlencode($category_filter) ?>" class="pagination-button">Previous</a>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <?php if ($i == $page): ?>
                            <span class="current-page"><?= $i ?></span>
                        <?php else: ?>
                            <a href="?search=<?= urlencode($search_query) ?>&page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&category=<?= urlencode($category_filter) ?>" class="pagination-button"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <?php if ($page < $total_pages): ?>
                        <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&category=<?= urlencode($category_filter) ?>" class="pagination-button">Next</a>
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
