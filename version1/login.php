<?php
include '_base.php';
include '_head.php';
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
            // Check if the user is banned
            if ($u->status == 'Banned') {
                temp('info', 'Your account has been banned.');
                redirect();
            } else {
                // Successful login for Admin or Active Member
                temp('info', 'Login successfully');
                if ($u->role == 'Admin') {
                    $redirectUrl = 'admin/admin.php';
                } elseif ($u->role == 'Member' && $u->status == 'Active') {
                    $redirectUrl = 'customer/customer.php';
                }

                login($u, $redirectUrl);
                exit();
            }
        } else {
            $_err['password'] = 'Not matched';
        }
    }
}

$_title = "Login";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <form method="post" action="" class="form">
        <div class="form-box">
            <div class="form-value">
                <h2>Login</h2>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <?= html_text('email', 'maxlength="100" required type="email"') ?>
                    <?= err('email') ?>
                    <label for="email">Email</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <?= html_password('password', 'maxlength="100" required') ?>
                    <?= err('password') ?>
                    <label for="password">Password</label>
                </div>
                <div class="forget">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <label>
                        <a href="forgot.php">Forgot password?</a>
                    </label>
                </div>
                <button type="submit">Log in</button>
                <div class="register">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </div>
            </div>
        </div>
    </form>

    <!-- Footer -->
    <?php
    include '_foot.php';
    ?>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>
