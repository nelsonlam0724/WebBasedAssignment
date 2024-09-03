<?php
include '../_base.php';

// Initialize error array
$_err = [];
if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE id = ?');
    $stm->execute([$_user->id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../loginAdmin.php');
    }
}
// Handle form submission
if (is_post()) {
    $name = req('name');
    $email = req('email');
    $password = req('password');
    $confirm = req('confirm');

    // Validate: email
    if (!$email) {
        $_err['email'] = 'Required';
    } else if (strlen($email) > 100) {
        $_err['email'] = 'Maximum 100 characters';
    } else if (!is_email($email)) {
        $_err['email'] = 'Invalid email';
    } else if (!is_unique($email, 'user', 'email')) {
        $_err['email'] = 'Duplicated';
    }

    // Validate: password
    if (!$password) {
        $_err['password'] = 'Required';
    } else if (strlen($password) < 5 || strlen($password) > 100) {
        $_err['password'] = 'Between 5-100 characters';
    }

    // Validate: confirm
    if (!$confirm) {
        $_err['confirm'] = 'Required';
    } else if (strlen($confirm) < 5 || strlen($confirm) > 100) {
        $_err['confirm'] = 'Between 5-100 characters';
    } else if ($confirm != $password) {
        $_err['confirm'] = 'Not matched';
    }

    // Validate: name
    if (!$name) {
        $_err['name'] = 'Required';
    } else if (strlen($name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
    }

    // Register user
    if (!$_err) {

        $stm = $_db->prepare('
            INSERT INTO user ( email,password,name,  photo, role)
            VALUES (?, SHA1(?), ?, "",  "Member")
        ');
        $stm->execute([$name, $email, $password]);

        temp('info', 'Record inserted');
        redirect('../loginAdmin.php');
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

        <label for="name">Name</label><br>
        <?= html_text('name', 'maxlength="100"') ?>
        <?= err('name') ?>
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