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

// Prepare SQL query with filters
$sql = 'SELECT * FROM category WHERE 1=1';
$params = [];

if ($search_query) {
    $sql .= ' AND category_name LIKE ?';
    $params[] = '%' . $search_query . '%';
}

if ($status_filter) {
    $sql .= ' AND category_status = ?'; // Changed to '=' for exact match
    $params[] = $status_filter;
}

$sql .= " ORDER BY $sort_by $sort_order";

// Count total records for pagination
$total_sql = 'SELECT COUNT(*) FROM category WHERE 1=1';
if ($search_query) {
    $total_sql .= ' AND category_name LIKE ?';
}
if ($status_filter) {
    $total_sql .= ' AND category_status = ?'; // Changed to '=' for exact match
}

// Prepare and execute total count query
$total_stmt = $_db->prepare($total_sql);
$total_stmt->execute($params);
$total_count = $total_stmt->fetchColumn();
$total_pages = ceil($total_count / $limit);

// Initialize pager with the main query
$pager = new SimplePager($sql, $params, $limit, $page);
$categories = $pager->result;

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
        <form method="post" action="deactivateCategory.php?page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>" onsubmit="return checkSelection(this);">
            <table class="table">
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
                                    <a href="categoryEdit.php?category_id=<?= $category->category_id ?>&page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>" class="edit-container">
                                        <button type="button" class="edit-button">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
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
                <button type="submit" formaction="deactivateCategory.php?page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>" id="deactivate-selected" onclick="return confirm('Are you sure you want to deactivate the selected categories?');">Deactivate</button>
                <button type="submit" formaction="activateCategory.php?page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>" id="activate-selected" onclick="return confirm('Are you sure you want to activate the selected categories?');">Activate</button>
            </div>

            <!-- Pagination Links -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=1&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>">First</a>
                <?php endif; ?>

                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>">Previous</a>
                <?php endif; ?>

                <?php
                $page_range = 2;
                $start_page = max(1, $page - $page_range);
                $end_page = min($total_pages, $page + $page_range);

                if ($start_page > 1): ?>
                    <a href="?page=1&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>">1</a>
                    <?php if ($start_page > 2): ?>
                        <span>...</span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                    <a href="?page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>" class="<?= $i == $page ? 'current-page' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($end_page < $total_pages): ?>
                    <?php if ($end_page < $total_pages - 1): ?>
                        <span>...</span>
                    <?php endif; ?>
                    <a href="?page=<?= $total_pages ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>">
                        <?= $total_pages ?>
                    </a>
                <?php endif; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>">Next</a>
                <?php endif; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $total_pages ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&search=<?= htmlspecialchars($search_query) ?>">Last</a>
                <?php endif; ?>
            </div>
        </form>
        <!-- "Add New Category" Button -->
        <div class="action-buttons">
            <a href="newCategory.php"><button type="button" id="add-new">Add New Category</button></a>
            <a href="admin.php"><button type="button" id="back-to-menu">Back To Menu</button></a>
        </div>
    </div>
</div>

<script>
    // JavaScript to handle select all functionality
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.category-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    function checkSelection(form) {
        const selected = Array.from(form.querySelectorAll('input[name="category_ids[]"]:checked'));
        if (selected.length === 0) {
            alert('Please select at least one category.');
            return false;
        }
        return true;
    }
</script>