<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php';
auth('Root', 'Admin');

// Retrieve the user ID from the query string
$user_id = isset($_GET['user_id']) ? trim($_GET['user_id']) : '';
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$role_filter = isset($_GET['role']) ? trim($_GET['role']) : '';
$status_filter = isset($_GET['status']) ? trim($_GET['status']) : '';
$sort_by = isset($_GET['sort_by']) ? trim($_GET['sort_by']) : 'user_id';
$sort_order = isset($_GET['sort_order']) ? trim($_GET['sort_order']) : 'ASC';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if (!$user_id) {
    redirect('userList.php?page='. $page .'&search=' . urlencode($search_query) . '&role=' . urlencode($role_filter) . '&status=' . urlencode($status_filter) . '&sort_by=' . urlencode($sort_by) . '&sort_order=' . urlencode($sort_order));
}

// Fetch the user details
$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_id]);
$user = $stm->fetch(PDO::FETCH_OBJ);

// Fetch the address details
$stm = $_db->prepare('SELECT * FROM address WHERE user_id = ?');
$stm->execute([$user_id]);
$address = $stm->fetch(PDO::FETCH_OBJ);

// Determine the current user's role
$current_role = $_user->role;
$current_user_id = $_user->user_id;

if ($current_role == 'Admin' && ($user->role == 'Root' || $user->role == 'Admin')) {
    temp('info', 'You do not have permission to edit this user.');
    redirect('admin.php');
}

$_title = 'User Details';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/userList.css">
</head>

<body>
    <div class="container">
        <h1>User Details</h1>

        <?php if ($user): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <td><?= htmlspecialchars($user->user_id) ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= htmlspecialchars($user->name) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($user->email) ?></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><?= htmlspecialchars($user->contact_num) ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?= htmlspecialchars($user->role) ?></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><?= htmlspecialchars($user->gender) ?></td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td><?= htmlspecialchars($user->birthday) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= htmlspecialchars($user->status) ?></td>
                </tr>
                <tr>
                    <th>Address Information</th>
                    <?php if ($address): ?>
                        <td>

                            <?= htmlspecialchars($address->street) ?>,
                            <?= htmlspecialchars($address->city) ?>,
                            <?= htmlspecialchars($address->state) ?>,
                            <?= htmlspecialchars($address->postal_code) ?>,
                            <?= htmlspecialchars($address->country) ?>
                        </td>
                    <?php else: ?>

                        <td>Address details not found.</td>

                    <?php endif; ?>
                <tr>
                    <th>Photo</th>
                    <td>
                        <?php if ($user->photo): ?>
                            <img src="../uploads/<?= htmlspecialchars($user->photo) ?>" alt="User Photo">
                        <?php else: ?>
                            No photo available
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p>User details not found.</p>
        <?php endif; ?>
        <div class="action-buttons">
            <a href="userList.php?page=<?= $page ?>&search=<?= urlencode($search_query) ?>
                                    &sort_by=<?= urlencode($sort_by) ?>&sort_order=<?= urlencode($sort_order) ?>
                                    &status=<?= urlencode($status_filter) ?>&role=<?= urlencode($role_filter) ?>">
                <button>Back to User List</button>
            </a>
        </div>
    </div>
</body>

</html>