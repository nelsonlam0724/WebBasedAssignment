<?php
include '_base.php';

// ----------------------------------------------------------------------------

if (is_post()) {
    $email = req('email');
    $password = req('password');

    // Validate: email
    if ($email == '') {
        $_err['email'] = 'Required';
    } else if (!is_email($email)) {
        $_err['email'] = 'Invalid email';
    }

    // Validate: password
    if ($password == '') {
        $_err['password'] = 'Required';
    }

    // Login user
    if (!$_err) {
        $stm = $_db->prepare('
            SELECT * FROM user
            WHERE email = ? AND password = SHA1(?)
        ');
        $stm->execute([$email, $password]);
        $u = $stm->fetch();

        if ($u) {
            temp('info', 'Login successfully');

            // Redirect based on role
            if ($u->role == 'Admin') {
                $redirectUrl = 'admin/admin.php';
            } elseif ($u->role == 'Member') {
                $redirectUrl = 'customerPage/product.php';
            }
            login($u,$redirectUrl);
            exit();
        } else {
            $_err['password'] = 'Not matched';
        }
    }
}

// ----------------------------------------------------------------------------

$_title = 'Login';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <form method="post" class="form">
        <label for="email">Email:</label>
        <?= html_text('email', 'maxlength="100" required type="email"') ?>
        <?= err('email') ?>
        <br>
        <label for="password">Password:</label>
        <?= html_password('password', 'maxlength="100" required') ?>
        <?= err('password') ?>
        <br>
        <button type="submit">Login</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>
