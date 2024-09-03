<?php
include '../_base.php';

if (!is_logged_in()) {
    echo 'Not logged in';
    // Optionally, you can also check the session variables
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    redirect('../loginAdmin.php');
}

// Fetch user profile information
$user = $_SESSION['user'];

$_title = 'Admin Dashboard - ' . htmlspecialchars($user->username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user->username) ?> to the Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="register.php">Register New Admin</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <p>Here you can manage your admin tasks.</p>
</body>
</html>
