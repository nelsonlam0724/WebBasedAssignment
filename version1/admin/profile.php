<?php
include '../_base.php';
include '../_head.php';

// Fetch user data if GET request
if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }

    $_SESSION['user'] = $u; // Store user data in session
}

$user = $_SESSION['user'];

// Handle form submission (POST request)
if (is_post()) {
    $new_email = req('new_email');
    $new_name = req('new_name');
    $new_password = req('new_password');
    $new_confirm = req('new_confirm');
    // Validate: email
    if (!$new_email) {
        $_err['new_email'] = 'Required';
    } else if (strlen($new_email) > 100) {
        $_err['new_email'] = 'Maximum 100 characters';
    } else if (!is_email($new_email)) {
        $_err['new_email'] = 'Invalid email';
    } else if (!is_unique($new_email, 'user', 'email')) {
        $_err['new_email'] = 'Duplicated';
    }

    // Validate: password
    if (!$new_password) {
        $_err['new_password'] = 'Required';
    } else if (strlen($new_password) < 5 || strlen($new_password) > 100) {
        $_err['new_password'] = 'Between 5-100 characters';
    }

    // Validate: confirm
    if (!$new_confirm) {
        $_err['new_confirm'] = 'Required';
    } else if (strlen($new_confirm) < 5 || strlen($new_confirm) > 100) {
        $_err['new_confirm'] = 'Between 5-100 characters';
    } else if ($new_confirm != $password) {
        $_err['new_confirm'] = 'Not matched';
    }

    // Validate: name
    if (!$new_name) {
        $_err['new_name'] = 'Required';
    } else if (strlen($new_name) > 100) {
        $_err['new_name'] = 'Maximum 100 characters';
    }

    // Update email
    if ($new_email) {
        $stm = $_db->prepare('UPDATE user SET email = ? WHERE user_id = ?');
        $stm->execute([$new_email, $user->user_id]);
        $_SESSION['user']->email = $new_email;
    }

    // Update username
    if ($new_name) {
        $stm = $_db->prepare('UPDATE user SET name = ? WHERE user_id = ?');
        $stm->execute([$new_name, $user->user_id]);
        $_SESSION['user']->name = $new_name;
    }

    // Update password
    if ($new_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stm = $_db->prepare('UPDATE user SET password = ? WHERE user_id = ?');
        $stm->execute([$hashed_password, $user->user_id]);
    }
    $_user->email = $email;
    $_user->name  = $name;
    
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
    <script src="../js/profile.js"></script>
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Admin Profile</h1>

    <!-- Display Admin Profile -->
    <div>
        <p><strong>Username:</strong> <?= htmlspecialchars($user->name) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user->email) ?></p>
        <button type="button" onclick="toggleEditForm()">Edit Profile</button>
    </div>

    <!-- Edit Form (Initially Hidden) -->
    <form id="editForm" method="post" class="form" style="display: none;">
        <label for="new_email">New Email:</label>
        <br>
        <?= html_text('new_email', 'maxlength="100" type="email"') ?>
        <?= err('new_email') ?>
        <br>
        <label for="new_name">New Username:</label>
        <br>
        <?= html_text('new_name', 'maxlength="100"') ?>
        <?= err('new_name') ?>
        <br>
        <label for="new_password">New Password:</label>
        <br>
        <?= html_password('new_password', 'maxlength="100"') ?>
        <?= err('new_password') ?>
        <br>
        <label for="new_confirm">Confirm</label>
        <br>
        <?= html_password('new_confirm', 'maxlength="100"') ?>
        <?= err('new_confirm') ?>
        <br>
        <button type="submit">Update Profile</button>
        <button type="button" onclick="toggleEditForm()">Cancel</button>
    </form>

    <br>
    <button><a href="admin.php">BACK TO MENU</a></button>
</body>

</html>