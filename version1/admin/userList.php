<?php
include '../_base.php';
include '../_head.php';
require_once '../lib/SimplePager.php';
include '../include/sidebarAdmin.php';

auth('Root', 'Admin');

$current_role = $_user->role;
$current_user_id = $_user->user_id;
if ($current_role == 'Root') {
    $arr = $_db->query('SELECT * FROM user WHERE role IN ("Member","Admin")')->fetchAll();
} elseif ($current_role == 'Admin') {
    $arr = $_db->query('SELECT * FROM user WHERE role = "Member"')->fetchAll();
} else {
    redirect('../login.php');
}

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

if ($current_role == 'Root') {
    $query .= ' AND role IN ("Admin", "Member")';
} elseif ($current_role == 'Admin') {
    $query .= ' AND role = "Member"';
}


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
$roles_stm = $_db->query('SELECT DISTINCT role FROM user WHERE role != "Root"');
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
    <script src="../js/search.js"></script>
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($_title) ?></h1>

        <!-- Search Form -->
        <form action="userList.php" method="get" id="searchForm">
            <input type="text" id="searchInput" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>" oninput="submitSearch()">
            <input type="hidden" name="role" value="<?= htmlspecialchars($role_filter) ?>">
            <input type="hidden" name="status" value="<?= htmlspecialchars($status_filter) ?>">
            <input type="hidden" name="sort_by" value="<?= htmlspecialchars($sort_by) ?>">
            <input type="hidden" name="sort_order" value="<?= htmlspecialchars($sort_order) ?>">
            <input type="hidden" name="page" value="1"> <!-- Always start at page 1 for new searches -->
        </form>
      
        <div class="user-count">
            <p>Total Users: <?= count($arr) ?></p>
        </div>
        <!-- Filter and Sorting Options -->
        <div class="filter-sorting">
            <form action="userList.php" method="get">
                <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
                <input type="hidden" name="page" value="1"> <!-- Always start at page 1 for new filters and sorting -->

                <!-- Role Filter -->
                <?php if ($current_role == 'Root'): ?>
                    <label for="role">Role:</label>
                    <select name="role" id="role" onchange="this.form.submit()">
                        <option value="">All Roles</option>
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= htmlspecialchars($role) ?>" <?= $role == $role_filter ? 'selected' : '' ?>>
                                <?= htmlspecialchars($role) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php elseif ($current_role == 'Admin'): ?>
                    <input type="hidden" name="role" value="Member">
                <?php endif; ?>

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
            </form>
        </div>

        <!-- User Table -->
        <?php if ($users): ?>
            <table>
                <thead>
                    <tr>
                        <th>
                            <a href="?sort_by=user_id&sort_order=<?= $sort_order == 'ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search_query) ?>&page=<?= $page ?>&role=<?= urlencode($role_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                ID <?= $sort_by == 'user_id' ? ($sort_order == 'ASC' ? '▲' : '▼') : '' ?>
                            </a>
                        </th>
                        <th>
                            <a href="?sort_by=name&sort_order=<?= $sort_order == 'ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search_query) ?>&page=<?= $page ?>&role=<?= urlencode($role_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                Username <?= $sort_by == 'name' ? ($sort_order == 'ASC' ? '▲' : '▼') : '' ?>
                            </a>
                        </th>
                        <th>
                            <a href="?sort_by=email&sort_order=<?= $sort_order == 'ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search_query) ?>&page=<?= $page ?>&role=<?= urlencode($role_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                Email <?= $sort_by == 'email' ? ($sort_order == 'ASC' ? '▲' : '▼') : '' ?>
                            </a>
                        </th>
                        <th>
                            <a href="?sort_by=status&sort_order=<?= $sort_order == 'ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search_query) ?>&page=<?= $page ?>&role=<?= urlencode($role_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                Status <?= $sort_by == 'status' ? ($sort_order == 'ASC' ? '▲' : '▼') : '' ?>
                            </a>
                        </th>
                        <th>
                            <a href="?sort_by=role&sort_order=<?= $sort_order == 'ASC' ? 'DESC' : 'ASC' ?>&search=<?= urlencode($search_query) ?>&page=<?= $page ?>&role=<?= urlencode($role_filter) ?>&status=<?= urlencode($status_filter) ?>">
                                Role <?= $sort_by == 'role' ? ($sort_order == 'ASC' ? '▲' : '▼') : '' ?>
                            </a>
                        </th>
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
                                <a href="displayUser.php?user_id=<?= urlencode($user->user_id) ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Details</button>
                                </a>
                            </td>
                            <td class="actions">
                                <a href="editUser.php?user_id=<?= urlencode($user->user_id) ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Edit</button>
                                </a>
                            </td>
                            <?php if ($user->status == 'Banned'): ?>
                                <td class="active">
                                    <form action="activeUser.php?user_id=<?= $user->user_id ?>&search=<?= urlencode($search_query) ?>
                                    &page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>
                                    &status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $user->user_id ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to active this user?');">Active</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                            <?php if ($user->status == 'Active'): ?>
                                <td class="deactivate">
                                    <form action="bannedUser.php?user_id=<?= $user->user_id ?>&search=<?= urlencode($search_query) ?>
                                    &page=<?= $page ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>
                                    &status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $user->user_id ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to banned this user?');">Banned</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

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
            <p class="no-results">No User found.</p>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="registerUser.php"><button>Register New User</button></a>
            <a href="admin.php"><button>Back To Menu</button></a>
        </div>
    </div>
</body>

</html>