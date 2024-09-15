<?php
include '../_base.php';
include '../_head.php';

auth('Root', 'Admin');  // Ensure both Root and Admin roles can access this page

// Get the current logged-in user role and user ID
$current_role = $_SESSION['user']->role;
$current_user_id = $_SESSION['user']->user_id;

// Get search query, page number, sort parameters, status filter, and role filter
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'user_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$status_filter = isset($_GET['status']) ? $_GET['status'] : ''; // Status filter
$role_filter = isset($_GET['role']) ? $_GET['role'] : ''; // Role filter

// Build SQL query with search filter, status filter, and role filter (without pagination and sorting)
$sql = 'SELECT * FROM user WHERE 1=1'; // Base query (fetch all users)
$params = [];

if ($current_role == 'Admin') {
    $sql .= ' AND role = ?';
    $params[] = 'member';
}

if ($role_filter) {
    $sql .= ' AND role = ?';
    $params[] = $role_filter;
}

if ($search_query) {
    $sql .= ' AND name LIKE ?';
    $params[] = '%' . $search_query . '%';
}

if ($status_filter) {
    $sql .= ' AND status = ?';
    $params[] = $status_filter;
}

// Fetch all filtered records
$stm = $_db->prepare($sql);
$stm->execute($params);
$all_filtered_users = $stm->fetchAll(PDO::FETCH_OBJ);

// Apply sorting to the filtered results
usort($all_filtered_users, function ($a, $b) use ($sort_by, $sort_order) {
    $valueA = $a->$sort_by;
    $valueB = $b->$sort_by;
    if ($sort_order === 'ASC') {
        return $valueA <=> $valueB;
    } else {
        return $valueB <=> $valueA;
    }
});

// Apply pagination to the sorted, filtered results
$total_records = count($all_filtered_users);
$total_pages = ceil($total_records / $records_per_page);
$users = array_slice($all_filtered_users, $offset, $records_per_page);

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
    <title><?= $_title ?></title>
</head>

<body>
    <div class="container">
        <h1>User List</h1>

        <!-- Search Form -->
        <form action="userList.php" method="get">
            <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit" class="form-button">Search</button>
        </form>

        <!-- Filter and Sorting Options -->
        <div class="filter-sorting">
            <form action="userList.php" method="get">
                <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
                <input type="hidden" name="page" value="<?= $page ?>">

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
                <?php else: ?>
                    <input type="hidden" name="role" value="member">
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
                                <a href="userDetails.php?user_id=<?= $user->user_id ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Details</button>
                                </a>
                            </td>
                            <td class="actions">
                                <a href="editUser.php?user_id=<?= $user->user_id ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Edit</button>
                                </a>
                            </td>
                            <?php if ($current_role == 'Root'): ?>
                                <td class="delete">
                                    <!-- If the current user is a root and not the same user, show Delete button -->
                                    <form action="deleteUser.php?user_id=<?= $user->user_id ?>&search=<?= urlencode($search_query) ?>
                                    &page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>
                                    &status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $user->user_id ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                            <?php if ($current_role == 'Admin' && $user->status != 'banned'): ?>
                                <td class="deactivate">
                                    <!-- If the current user is a root and not the same user, show Deactivate button -->
                                    <form action="deactivateUser.php?user_id=<?= $user->user_id ?>&search=<?= urlencode($search_query) ?>
                                    &page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>
                                    &status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $user->user_id ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to deactivate this user?');">Deactivate</button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
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

                // Display "First" link if there are skipped pages
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

                <!-- Display "Last" link if there are skipped pages -->
                <?php if ($end_page < $total_pages): ?>
                    <?php if ($end_page < $total_pages - 1): ?>
                        <span>...</span>
                    <?php endif; ?>
                    <a href="?page=<?= $total_pages ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>"><?= $total_pages ?></a>
                <?php endif; ?>

                <!-- Next Page Link -->
                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>">Next</a>
                <?php endif; ?>
            </div>
x
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