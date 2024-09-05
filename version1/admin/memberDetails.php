<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    // Retrieve the member ID from the query string
    // Fetch the member details
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$user_id]);
    $member = $stm->fetch(PDO::FETCH_OBJ);

    if ($u->role != "Admin") {
        redirect('../login.php');
    }
    
    $user_id = $_GET['user_id'] ?? null;

    if (!$user_id) {
        redirect('memberList.php'); // Redirect if no user ID is provided
    }
} else {
    redirect('memberList.php'); // Redirect if not a GET request
}
// Get the page and search query from the URL
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

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
                <th>Status</th>
                <td><?= htmlspecialchars($member->status) ?></td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>
                    <?php if ($member->photo): ?>
                        <img src="../uploads/<?= htmlspecialchars($member->photo) ?>" alt="Member Photo" style="max-width: 200px;">
                    <?php else: ?>
                        No photo available
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    <?php else: ?>
        <p>Member details not found.</p>
    <?php endif; ?>
    <a href="memberList.php?page=<?= $page ?>&search=<?= urlencode($search_query) ?>">
        <button>Back to Member List</button>
    </a>
</body>

</html>