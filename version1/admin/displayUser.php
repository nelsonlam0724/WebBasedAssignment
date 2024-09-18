<?php
include '../_base.php';
include '../_head.php';

auth('Root', 'Admin');

// Retrieve the user ID from the query string
$user_id = isset($_GET['user_id']) ? trim($_GET['user_id']) : '';
if (!$user_id) {
    redirect('userList.php');
}

// Fetch the user details
$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_id]);
$user = $stm->fetch(PDO::FETCH_OBJ);

// Fetch the address details
$stm = $_db->prepare('SELECT * FROM address WHERE user_id = ?');
$stm->execute([$user_id]);
$address = $stm->fetch(PDO::FETCH_OBJ);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
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
        <a href="userList.php?page=<?= $page ?>&search=<?= urlencode($search_query) ?>">
            <button>Back to User List</button>
        </a>
        </div>
    </div>
</body>

</html>
