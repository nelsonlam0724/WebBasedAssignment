<?php
include '../_base.php';
include '../_head.php';

auth('Admin');
// Fetch user profile information
$user = $_SESSION['user'];

$_title = 'Admin Dashboard - ' . htmlspecialchars($user->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Welcome, <?= htmlspecialchars($user->name) ?> to the Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="profile.php">Admin Profile</a></li>
            <li><a href="memberList.php">Member List</a></li>
            <li><a href="backup.php">Backup</a></li>
            <li><a href="restore.php">Restore</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
    <p>Here you can manage your admin tasks.</p>
</body>

</html>