<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php'; 
auth('Root', 'Admin');

// Check if ID is provided in the URL
if (!isset($_GET['user_id'])) {
    redirect('userList.php');
}

$user_id = $_GET['user_id'];

// Fetch the user's details
$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_id]);
$user = $stm->fetch(PDO::FETCH_OBJ);

// Determine the current user's role
$current_role = $_user->role;
$current_user_id = $_user->user_id;

if ($current_role == 'Admin' && ($user->role == 'Root' || $user->role == 'Admin')) {
    temp('info', 'You do not have permission to edit this user.');
    redirect('admin.php');
}

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
                    <th>Photo</th>
                    <td>
                        <?php if ($user->photo): ?>
                            <img src="../uploads/<?= htmlspecialchars($user->photo) ?>" alt="User Photo">
                        <?php else: ?>
                            <img src="../photo/photo.jpg" alt="User Photo">
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        <?php else: ?>
            <p>User details not found.</p>
        <?php endif; ?>
    </div>
    <div class="action-buttons">
        <a href="orderList.php"><button>Back To Order List</button></a>
    </div>
</body>

</html>
