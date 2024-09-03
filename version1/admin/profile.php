<?php
include '../_base.php';

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
    $new_username = req('new_username');
    $new_password = req('new_password');

    if ($new_email) {
        // Update email
        $stm = $_db->prepare('UPDATE admin SET email = ? WHERE id = ?');
        $stm->execute([$new_email, $user->id]);
        $_SESSION['user']->email = $new_email; // Update session user
    }

    if ($new_username) {
        //Update Username
        $stm = $_db->prepare('UPDATE admin SET username = ? WHERE username = ?');
        $stm->execute([$new_username, $user->username]);
    }

    if ($new_password) {
        // Update password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stm = $_db->prepare('UPDATE admin SET password = ? WHERE id = ?');
        $stm->execute([$hashed_password, $user->id]);
    }

    temp('info', 'Profile updated successfully');
    redirect('admin.php');
}

$_title = 'Admin Profile';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Admin Profile</h1>
    <form method="post" class="form">
        <label for="current_username">Current Username: </label>
        <label style="font-style:italic;font-size:20px;"><?= htmlspecialchars($user->username) ?></label>
        <br>
        <label for="new_email">New Email:</label>
        <br>
        <?= html_text('new_email', 'maxlength="100" required type="email"') ?>
        <br>
        <label for="new_username">New UserName:</label>
        <br>
        <?= html_text('new_username', 'maxlength="100"') ?>
        <br>
        <label for="new_password">New Password:</label>
        <br>
        <?= html_password('new_password', 'maxlength="100"') ?>
        <br>
        <button type="submit">Update Profile</button>
        <button><a href="admin.php">BACK TO MENU</a></button>
    </form>
</body>

</html>