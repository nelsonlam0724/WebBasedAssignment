<?php
include '../_base.php';
include '../_head.php';

// Handle user authentication
if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}

// Get search query and page number
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 4;
$offset = ($page - 1) * $records_per_page;

// Build SQL query with search filter
$sql = 'SELECT * FROM user WHERE role = ?';
$params = ['Member'];

if ($search_query) {
    $sql .= ' AND name LIKE ?';
    $params[] = '%' . $search_query . '%';
}

// Count total records for pagination
$count_stm = $_db->prepare($sql);
$count_stm->execute($params);
$total_records = $count_stm->rowCount();
$total_pages = ceil($total_records / $records_per_page);

// Fetch records for current page
$sql .= ' LIMIT ' . $records_per_page . ' OFFSET ' . $offset;
$stm = $_db->prepare($sql);
$stm->execute($params);
$members = $stm->fetchAll(PDO::FETCH_OBJ);

$_title = 'Member List';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Member List</h1>

    <form action="memberList.php" method="get">
        <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($search_query) ?>">
        <button type="submit">Search</button>
    </form>

    <?php if ($members): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
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
                        <td><?= htmlspecialchars($member->role) ?></td>
                        <td>
                            <a href="memberDetails.php?user_id=<?= $member->user_id ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>">
                                <button>View Details</button>
                            </a>
                        </td>
                        <td>
                            <a href="editMember.php?user_id=<?= $member->user_id ?>&page=<?= $page ?>&search=<?= urlencode($search_query) ?>">
                                <button>Edit</button>
                            </a>
                        </td>
                        <td>
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
        <div>
            <?php if ($page > 1): ?>
                <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page - 1 ?>"><button>Previous</button> </a>
            <?php endif; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?search=<?= urlencode($search_query) ?>&page=<?= $page + 1 ?>"> <button>Next</button></a>
            <?php endif; ?>
        </div>

    <?php else: ?>
        <p>No members found.</p>
    <?php endif; ?>
    <br>
    <a href="registerMember.php"><button>Register New Member</button></a>

    <br>
    <a href="admin.php"><button>Back To Menu</button></a>
</body>

</html>