<?php
    include '../_base.php';

    $user_id = req('user_id');

    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$user_id]);
    $user = $stm->fetch();


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
                            No photo available
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
