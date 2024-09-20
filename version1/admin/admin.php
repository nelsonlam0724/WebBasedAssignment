<?php
include '../_base.php';
include '../_head.php';
include 'sidebar.php'; 

$_title = 'Admin Dashboard - ' . htmlspecialchars($_user->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminWelcome.css">
    <title><?= $_title ?></title>
</head>
<body>
    <div class="main-content" id="main-content">
        <h1>Welcome, <?= htmlspecialchars($_user->name) ?> to the Admin Dashboard</h1>
        <p>Here you can manage your admin tasks.</p>
    </div>
</body>

</html>
