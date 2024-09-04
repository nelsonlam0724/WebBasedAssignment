<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    // Retrieve the member ID from the query string
    $user_id = $_GET['user_id'] ?? null;

    if (!$user_id) {
        redirect('memberList.php'); // Redirect if no user ID is provided
    }

    // Fetch the member details
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$user_id]);
    $member = $stm->fetch(PDO::FETCH_OBJ);

    if (!$member) {
        redirect('memberList.php'); // Redirect if member not found
    }
} else {
    redirect('memberList.php'); // Redirect if not a GET request
}

$_title = 'Member Details';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Member Details</h1>

    <?php if ($member): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <td><?= htmlspecialchars($member->user_id) ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><?= htmlspecialchars($member->name) ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($member->email) ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?= htmlspecialchars($member->role) ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?= htmlspecialchars($member->gender) ?></td>
            </tr>
            <tr>
                <th>Birthday</th>
                <td><?= htmlspecialchars($member->birthday) ?></td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                    <?php if ($member->photo): ?>
                    
                     <img src="../uploads/<?= $_user->photo ?>" alt="Member Photo" style="max-width: 200px;">
 
                        <?php else: ?>
                        No photo available
                    <?php endif; ?>
                </td>
            </tr>
            <!-- Add more fields as necessary -->
        </table>
    <?php else: ?>
        <p>Member details not found.</p>
    <?php endif; ?>

    <button><a href="memberList.php">Back to Member List</a></button>
</body>

</html>
