<?php
include '../_base.php';

// Initialize error array
$_err = [];

// Handle form submission
if (is_post()) {
    $username = req('username');
    $email = req('email');
    $password = req('password');
    $confirm_password = req('confirm_password');

    // Validate: username
    if ($username == '') {
        $_err['username'] = 'Required';
    } else if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        $_err['username'] = 'Invalid username (3-20 characters, letters, numbers, or underscores)';
    } else {
        // Check if username already exists
        $stm = $_db->prepare('SELECT * FROM admin WHERE username = ?');
        $stm->execute([$username]);
        if ($stm->fetch()) {
            $_err['username'] = 'Username already registered';
        }
    }

    // Validate: email
    if ($email == '') {
        $_err['email'] = 'Required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_err['email'] = 'Invalid email address';
    } else {
        // Check if email already exists
        $stm = $_db->prepare('SELECT * FROM admin WHERE email = ?');
        $stm->execute([$email]);
        if ($stm->fetch()) {
            $_err['email'] = 'Email already registered';
        }
    }

    // Validate: password
    if ($password == '') {
        $_err['password'] = 'Required';
    } else if ($password !== $confirm_password) {
        $_err['confirm_password'] = 'Passwords do not match';
    }

    // Register user
    if (!$_err) {

        $stm = $_db->prepare('
            INSERT INTO admin (name,email, password)
            VALUES (?, ?,  SHA1(?))
        ');
        $stm->execute([$username, $email, $password]);

        temp('info', 'Record inserted');
        redirect('../login.php');
    }
}

$_title = 'Register Admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Register Admin</h1>
    <?php if (isset($_err['general'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_err['general']) ?></p>
    <?php endif; ?>
    <form method="post" class="form">

        <label for="username">Name</label><br>
        <?= html_text('username', 'maxlength="100"') ?>
        <?= err('username') ?>
        <br>
        <label for="email">Email</label><br>
        <?= html_text('email', 'maxlength="100"') ?>
        <?= err('email') ?>
        <br>
        <label for="password">Password</label><br>
        <?= html_password('password', 'maxlength="100"') ?>
        <?= err('password') ?>
        <br>
        <label for="confirm">Confirm</label><br>
        <?= html_password('confirm', 'maxlength="100"') ?>
        <?= err('confirm') ?>
        <br>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="../loginAdmin.php">Login</a></p>
</body>

</html>