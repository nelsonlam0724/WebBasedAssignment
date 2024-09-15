<?php
include '../_base.php';
include '../_head.php';

auth('Role','Admin','Member');
// Fetch user profile information
$user = $_SESSION['user'];

$_title = 'Customer Dashboard - ' . htmlspecialchars($user->name);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($user->name) ?></h1>
    <nav>
        <ul>
            <li><a href="customerProfile.php">Member Profile</a></li>
            <li><a href="product.php">Product Page</a></li>
            <li><a href="information.php">View Details</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
</nav>
</body>
</html>