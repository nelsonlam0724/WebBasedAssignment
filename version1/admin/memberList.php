<?php
include '../_base.php';
include '../_head.php';

auth('Admin');

// Get search query, page number, sort parameters, and status filter
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'user_id'; // Default sort by id
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // Default sort order ascending
$status_filter = isset($_GET['status']) ? $_GET['status'] : ''; // Status filter

// Build SQL query with search filter, status filter, and sorting
$sql = 'SELECT * FROM user WHERE role = ?';
$params = ['Member'];

if ($search_query) {
    $sql .= ' AND name LIKE ?';
    $params[] = '%' . $search_query . '%';
}

if ($status_filter) {
    $sql .= ' AND status = ?';
    $params[] = $status_filter;
}

// Count total records for pagination (use a separate query without LIMIT)
$count_sql = 'SELECT COUNT(*) FROM user WHERE role = ?';
if ($search_query) {
    $count_sql .= ' AND name LIKE ?';
}
if ($status_filter) {
    $count_sql .= ' AND status = ?';
}
$count_stm = $_db->prepare($count_sql);
$count_stm->execute($params);
$total_records = $count_stm->fetchColumn();
$total_pages = ceil($total_records / $records_per_page);

// Add sorting to the SQL query
$sql .= ' ORDER BY ' . $sort_by . ' ' . $sort_order;

// Fetch records for current page
$sql .= ' LIMIT ' . $records_per_page . ' OFFSET ' . $offset;
$stm = $_db->prepare($sql);
$stm->execute($params);
$members = $stm->fetchAll(PDO::FETCH_OBJ);

$_title = 'Member List';

// Fetch statuses for filter options
$statuses_stm = $_db->query('SELECT DISTINCT status FROM user');
$statuses = $statuses_stm->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/memberList.css">
</head>

<body>
    <div class="container">
        <h1>Member List</h1>

        <!-- Search Form -->
        <form action="memberList.php" method="get">
            <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>">
            <button type="submit" class="form-button">Search</button>
        </form>

        <!-- Filter and Sorting Options -->
        <div class="filter-sorting">
            <form action="memberList.php" method="get">
                <input type="hidden" name="search" value="<?= htmlspecialchars($search_query) ?>">
                <input type="hidden" name="page" value="<?= $page ?>">

                <!-- Status Filter -->
                <label for="status">Status:</label>
                <select name="status" id="status" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
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
                    <option value="role" <?= $sort_by == 'role' ? 'selected' : '' ?>>Role</option>
                    <option value="status" <?= $sort_by == 'status' ? 'selected' : '' ?>>Status</option>
                </select>
                <label for="sort_order">Order:</label>
                <select name="sort_order" id="sort_order" onchange="this.form.submit()">
                    <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                    <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                </select>
            </form>
        </div>

        <!-- Members Table -->
        <?php if ($members): ?>
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
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?= htmlspecialchars($member->user_id) ?></td>
                            <td><?= htmlspecialchars($member->name) ?></td>
                            <td><?= htmlspecialchars($member->email) ?></td>
                            <td><?= htmlspecialchars($member->status) ?></td>
                            <td><?= htmlspecialchars($member->role) ?></td>

                            <td class="actions">
                                <a href="memberDetails.php?user_id=<?= $member->user_id ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Details</button>
                                </a>
                            </td>
                            <td class="actions">
                                <a href="editMember.php?user_id=<?= $member->user_id ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>">
                                    <button>Edit</button>
                                </a>
                            </td>
                            <td class="delete">
                                <form action="deleteMember.php?user_id=<?= $member->user_id ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $member->user_id ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination">
                <!-- Previous Button -->
                <?php if ($page > 1): ?>
                    <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page - 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">Previous</a>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $page): ?>
                        <span class="current-page"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?search=<?= urlencode($search_query) ?>&page=<?= $i ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <!-- Next Button -->
                <?php if ($page < $total_pages): ?>
                    <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page + 1 ?>&sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>&status=<?= urlencode($status_filter) ?>">Next</a>
                <?php endif; ?>
            </div>

        <?php else: ?>
            <p class="no-results">No members found.</p>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="registerMember.php"><button>Register New Member</button></a>
            <a href="admin.php"><button>Back To Menu</button></a>
        </div>
    </div>
</body>

</html>