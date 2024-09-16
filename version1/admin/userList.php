<?php
include '../_base.php';
include '../_head.php';
require_once '../lib/SimplePager.php'; // Include SimplePager class

auth('Root', 'Admin');  // Ensure both Root and Admin roles can access this page

// Initialize variables
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$role_filter = isset($_GET['role']) ? trim($_GET['role']) : '';
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'user_id';
$sort_order = isset($_GET['sort_order']) ? trim($_GET['sort_order']) : 'ASC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Number of records per page

// Start constructing the query
$query = 'SELECT * FROM user WHERE 1=1';
$params = [];

// Add search condition if provided
if ($search_query) {
    $query .= ' AND name LIKE ?';
    $params[] = '%' . $search_query . '%';
}

// Add role filter if provided
if ($role_filter) {
    $query .= ' AND role = ?';
    $params[] = $role_filter;
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
$users = $pager->result;
$total_pages = $pager->page_count;

// Fetch roles and statuses for filter options
$roles_stm = $_db->query('SELECT DISTINCT role FROM user');
$roles = $roles_stm->fetchAll(PDO::FETCH_COLUMN);

$statuses_stm = $_db->query('SELECT DISTINCT status FROM user');
$statuses = $statuses_stm->fetchAll(PDO::FETCH_COLUMN);

$_title = 'User List';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/userList.css">
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($_title) ?></h1>

        <!-- Search Form -->
        <form action="userList.php" method="get">
            <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>">
            <input type="hidden" name="role" value="<?= htmlspecialchars($role_filter) ?>">
            <input type="hidden" name="status" value="<?= htmlspecialchars($status_filter) ?>">
            <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
            <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>">
            <input type="hidden" name="page" value="1"> <!-- Always start at page 1 for new searches -->
            <button type="submit" class="form-button">Search</button>
        </form>

        <!-- Filter and Sorting Options -->
        <div class="filter-sorting">
            <form action="userList.php" method="get">
                <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
                <input type="hidden" name="page" value="1"> <!-- Always start at page 1 for new filters and sorting -->

                <!-- Role Filter -->
                <label for="role">Role:</label>
                <select name="role" id="role" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= htmlspecialchars($role) ?>" <?= $role == $role_filter ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role) ?>
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
                    <option value="user_id" <?= $sort_by == 'user_id' ? 'selected' : '' ?>>ID</option>
                    <option value="name" <?= $sort_by == 'name' ? 'selected' : '' ?>>Username</option>
                    <option value="email" <?= $sort_by == 'email' ? 'selected' : '' ?>>Email</option>
                    <option value="status" <?= $sort_by == 'status' ? 'selected' : '' ?>>Status</option>
                </select>
                <label for="sort_order">Order:</label>
                <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                    <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                    <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                </select>
            </form>
        </div>


        <!-- User Table -->
        <?php if ($users): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user->user_id) ?></td>
                            <td><?= htmlspecialchars($user->name) ?></td>
                            <td><?= htmlspecialchars($user->email) ?></td>
                            <td><?= htmlspecialchars($user->status) ?></td>
                            <td><?= htmlspecialchars($user->role) ?></td>
                            <td class="actions">
                                <a href="userDetails.php?user_id=<?= urlencode($user->user_id) ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Details</button>
                                </a>
                            </td>
                            <td class="actions">
                                <a href="editUser.php?user_id=<?= urlencode($user->user_id) ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Edit</button>
                                </a>
                            </td>
                            <td class="actions">
                                <a href="deleteUser.php?user_id=<?= urlencode($user->user_id) ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination">
                <!-- Previous Page Link -->
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>">Previous</a>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php
                $page_range = 2; // Number of pages to show before and after the current page
                $start_page = max(1, $page - $page_range);
                $end_page = min($total_pages, $page + $page_range);

                if ($start_page > 1): ?>
                    <a href="?page=1&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>">1</a>
                    <?php if ($start_page > 2): ?>
                        <span>...</span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                    <a href="?page=<?= $i ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>" class="<?= $i == $page ? 'current-page' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($end_page < $total_pages): ?>
                    <?php if ($end_page < $total_pages - 1): ?>
                        <span>...</span>
                    <?php endif; ?>
                    <a href="?page=<?= $total_pages ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>">
                        <?= $total_pages ?>
                    </a>
                <?php endif; ?>

                <!-- Next Page Link -->
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>">Next</a>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <p class="no-results">No User found.</p>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="registerUser.php"><button>Register New User</button></a>
            <a href="admin.php"><button>Back To Menu</button></a>
        </div>
    </div>
</body>

</html>