<?php
include '../_base.php';
require_once '../lib/SimplePager.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'category_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$status_filter = isset($_GET['status']) ? $_GET['status'] : ''; // Status filter
$limit = 5;

// Select categories with status filter
$sql = 'SELECT * FROM category WHERE 1=1';
$params = [];

if ($search_query) {
    $sql .= ' AND category_name LIKE ?';
    $params[] = '%' . $search_query . '%';
}

if ($status_filter) {
    $sql .= ' AND category_status LIKE ?';
    $params[] = $status_filter;
}

$sql .= " ORDER BY $sort_by $sort_order";

$pager = new SimplePager($sql, $params, $limit, $page);
$categories = $pager->result;
$total_pages = $pager->page_count;

// Fetch all unique statuses from the category table
$status_stm = $_db->query('SELECT DISTINCT category_status FROM category');
$statuses = $status_stm->fetchAll(PDO::FETCH_COLUMN);

$_title = 'Category List';
include '../_head.php';
?>

<link rel="stylesheet" href="../css/product.css">

<div class="container">
    <h1>Category List</h1>

    <!-- Search Form -->
    <form action="categoryList.php" method="get" class="search-form">
        <input type="text" name="search" placeholder="Search category" value="<?= htmlspecialchars($search_query) ?>">
        <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
        <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>">
        <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
        <button type="submit" class="form-button">Search</button>
    </form>

    <!-- Filter and Sorting Options -->
    <div class="filter-sorting">
        <form action="categoryList.php" method="get" class="filter-form">
            <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
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
                <option value="category_id" <?= $sort_by == 'category_id' ? 'selected' : '' ?>>ID</option>
                <option value="category_name" <?= $sort_by == 'category_name' ? 'selected' : '' ?>>Name</option>
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
        <!-- Category Table with Checkboxes -->
        <form method="post" action="deactivateCategory.php" onsubmit="return checkSelection(this);">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($categories): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="category_ids[]" value="<?= $category->category_id ?>" class="category-checkbox">
                                </td>
                                <td><?= htmlspecialchars($category->category_id) ?></td>
                                <td><?= htmlspecialchars($category->category_name) ?></td>
                                <td><?= htmlspecialchars($category->category_status) ?></td>
                                <td class="actions">
                                    <?php if ($category->category_status === 'Activate'): ?>
                                        <form method="post" action="deactivateCategory.php" class="inline-form">
                                            <input type="hidden" name="category_id" value="<?= $category->category_id ?>">
                                            <button type="submit" onclick="return confirm('Are you sure you want to deactivate this category?');">Deactivate</button>
                                        </form>
                                    <?php else: ?>
                                        <form method="post" action="activateCategory.php" class="inline-form">
                                            <input type="hidden" name="category_id" value="<?= $category->category_id ?>">
                                            <button type="submit" onclick="return confirm('Are you sure you want to activate this category?');">Activate</button>
                                        </form>
                                    <?php endif; ?>

                                    <!-- Product Edit Action -->
                                    <a href="categoryEdit.php?category_id=<?= $category->category_id ?>" class="edit-container">
                                        <button type="button" class="edit-button">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="no-results">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="action-buttons">
                <button type="submit" formaction="deactivateCategory.php" id="deactivate-selected" onclick="return confirm('Are you sure you want to deactivate the selected categories?');">Deactivate Selected</button>
                <button type="submit" formaction="activateCategory.php" id="activate-selected" onclick="return confirm('Are you sure you want to activate the selected categories?');">Activate Selected</button>
            </div>
        </form>
    </div>

    <div class="pagination-container">
        <!-- Previous Button -->
        <?php if ($page > 1): ?>
            <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>" class="pagination-button">Previous</a>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <?php if ($i == $page): ?>
                <span class="current-page"><?= $i ?></span>
            <?php else: ?>
                <a href="?search=<?= urlencode($search_query) ?>&page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>" class="pagination-button"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- Next Button -->
        <?php if ($page < $total_pages): ?>
            <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>" class="pagination-button">Next</a>
        <?php endif; ?>
    </div>

    <!-- "Add New Category" Button -->
    <div class="action-buttons">
        <a href="newCategory.php"><button type="button" id="add-new">Add New Category</button></a>
        <a href="admin.php"><button type="button" id="back-to-menu">Back To Menu</button></a>
    </div>
</div>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        var checkboxes = document.querySelectorAll('.category-checkbox');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    });

    function checkSelection(form) {
        var checkboxes = document.querySelectorAll('.category-checkbox');
        var anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (!anyChecked) {
            alert('Please select at least one category to deactivate.');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
