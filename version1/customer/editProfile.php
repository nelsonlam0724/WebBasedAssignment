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

if (is_post()) {
    $new_email = req('new_email');
    $new_name = req('new_name');
    $new_password = req('new_password');

    if ($new_email) {
        $stm = $_db->prepare('UPDATE user SET email = ? WHERE id = ?');
        $stm->execute([$new_email, $user->id]);
        $_SESSION['user']->email = $new_email;
    }

    if ($new_name) {
        $stm = $_db->prepare('UPDATE user SET name = ? WHERE id = ?');
        $stm->execute([$new_name, $user->id]);
        $_SESSION['user']->name = $new_name;
    }

    if ($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stm = $_db->prepare('UPDATE user SET password = ? WHERE id = ?');
        $stm->execute([$hashed_password, $user->id]);
    }

    temp('info', 'Profile updated successfully');
    redirect('editProfile.php');
}

$_title = 'Edit Profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>
<body>
    <h1>Edit Profile</h1>

    <form method="post">
        <label for="new_name">New Username:</label>
        <input type="text" id="new_name" name="new_name" maxlength="100">
        <br>
        <label for="new_email">New Email:</label>
        <input type="email" id="new_email" name="new_email" maxlength="100">
        <br>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" maxlength="100">
        <br>
        <button type="submit">Update Profile</button>
    </form>

    <button><a href="customer.php">Back to Menu</a></button>
</body>
</html>
