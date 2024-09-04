<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}

// Fetch all members
$stm = $_db->prepare('SELECT * FROM user WHERE role = ?');
$stm->execute(['Member']);
$members = $stm->fetchAll(PDO::FETCH_OBJ); // Fetch all as objects

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
                            <button><a href="memberDetails.php?user_id=<?= $member->user_id ?>">View Details</a></button>
                        </td>
                        <td>
                            <button><a href="editMember.php?user_id=<?= $member->user_id ?>">Edit</a></button>

                        </td>
                        <td>
                            <form action="deleteMember.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $member->user_id ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this member?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>No members found.</p>
    <?php endif; ?>

    <button>
        <a href="registerMember.php">Register New Member</a>
    </button>

    <br>
    <button><a href="admin.php">BACK TO MENU</a></button>
</body>

</html>