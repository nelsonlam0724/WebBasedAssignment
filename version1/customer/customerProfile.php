<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE id = ?');
    $stm->execute([$_user->id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}

$user = $_SESSION['user'];

$_title = 'Member Profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>
<body>
    <h1>Member Profile</h1>

    <p><strong>ID:</strong> <?= htmlspecialchars($user->id) ?></p>
    <p><strong>Username:</strong> <?= htmlspecialchars($user->name) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user->email) ?></p>

    <button><a href="editProfile.php">Edit Profile</a></button><br>
    <button><a href="customer.php">Back to Menu</a></button><br>
    <button><a href="logout.php">Logout</a></button>
</body>
</html>
