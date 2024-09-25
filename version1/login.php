<?php
include '_base.php';
include '_head.php';
// ----------------------------------------------------------------------------
if (isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $stm = $_db->prepare('SELECT * FROM user WHERE remember_token = ? AND remember_token_expiry > NOW()');
    $stm->execute([$token]);
    $u = $stm->fetch(PDO::FETCH_OBJ);

    if ($u) {
        // Automatically log the user in if the token is valid
        if ($u->role == 'Admin' ||$u->role == 'Root') {
            $redirectUrl = 'admin/admin.php';
        } elseif ($u->role == 'Member' && $u->status == 'Active') {
            $redirectUrl = 'customer/customer.php';
        }
        login($u, $redirectUrl); // Log the user in and redirect
        exit();
    }
}
//------------------------------------------------------------------------------
if (is_post()) {
    $email = req('email');
    $password = req('password');
    $remember_me = isset($_POST['remember']);

    // Validate: email
    if ($email == '') {
        $_err['email'] = 'Required';
    } else if (!is_email($email)) {
        $_err['email'] ='<p style="color:white">'. 'Invalid email'.'</p>';
    }

    // Validate: password
    if ($password == '') {
        $_err['password'] ='<p style="color:white">'. 'Required'.'</p>';
    }
    // Login user
    if (!$_err) {
        $stm = $_db->prepare('
            SELECT * FROM user
            WHERE email = ?
        ');
        $stm->execute([$email]);
        $u = $stm->fetch(PDO::FETCH_OBJ);

        $current_time = new DateTime();

        if ($u) {
            // Check if the user is banned
            if ($u->status == 'Banned') {
                temp('info', 'Your account is banned.');
                redirect();
            } else if ($u->status == 'Deactivate') {
                // Calculate remaining time until deactivation period is over
                $deactivation_time = new DateTime($u->deactivated_at);
                $remaining_time = $deactivation_time->add(new DateInterval('PT1M')); // Adding 5 minutes
                $remaining_interval = $current_time->diff($remaining_time);

                if ($current_time < $remaining_time) {
                    temp('info', 'Your account is deactivated. Please wait ' . $remaining_interval->s . ' seconds before reactivation.');
                } else {
                    // Convert to banned if the deactivation period is over
                    $stm = $_db->prepare('
                        UPDATE user
                        SET status = "Banned"
                        WHERE email = ?
                    ');
                    $stm->execute([$email]);
                    temp('info', 'Your account has been converted to banned status.');
                }
                redirect();
            } else if ($u->banned_until && $current_time < new DateTime($u->banned_until)) {
                // User is banned and the ban period is not over
                $remaining_ban_time = (new DateTime($u->banned_until))->diff($current_time);
                temp('info', 'Your account is banned. Try again after ' . $remaining_ban_time->s . ' seconds.');
                redirect();
            } else {
                // Ban period is over, reset status
                $stm = $_db->prepare('
                    UPDATE user
                    SET status = "Active", banned_until = NULL
                    WHERE email = ?
                ');
                $stm->execute([$email]);
            }

// Get current time
$current_time = new DateTime();

// Check frequent login/logouts
if ($u->last_login_event_time) {
    $last_event_time = new DateTime($u->last_login_event_time);
    // Calculate the difference in minutes
    $diff_minutes = $current_time->diff($last_event_time)->i; // 'i' gets the difference in minutes

    if ($diff_minutes < 3 && $u->login_count >= 3) {
        // If login attempts are too frequent within a 3-minute window
        $remaining_time = 3 - $diff_minutes; // Time left to wait before trying again
        temp('info', 'Frequent login attempts detected. Please wait '.$remaining_time. ' minutes before trying again.');
        redirect(); // Stop further login processing
    } else if ($diff_minutes >= 3) {
        // Reset login count after 3 minutes have passed
        $stm = $_db->prepare('
            UPDATE user
            SET login_count = 0
            WHERE email = ?
        ');
        $stm->execute([$email]);
    }
}

            // Check if password matches
            if (sha1($password) === $u->password) {
                // Successful login
                $stm = $_db->prepare('
                    UPDATE user
                    SET failed_attempts = 0, banned_until = NULL, last_login_time = ?, login_count = login_count + 1, last_login_event_time = ?
                    WHERE email = ?
                ');
                $stm->execute([$current_time->format('Y-m-d H:i:s'), $current_time->format('Y-m-d H:i:s'), $email]);

                //remember me cookie 14 day
                if ($remember_me) {
                    $token = bin2hex(random_bytes(16)); // Generate a random token
                    $expiry_time = time() + (86400 * 14); // Set the token to expire in 14 days

                    // Store the token in the database
                    $stm = $_db->prepare('UPDATE user SET remember_token = ?, remember_token_expiry = ? WHERE email = ?');
                    $stm->execute([$token, date('Y-m-d H:i:s', $expiry_time), $email]);

                    // Set a cookie with the token that expires in 30 days
                    setcookie('remember_token', $token, $expiry_time, '/', '', false, true);
                }

                temp('info', 'Login Successfully.');
                if ($u->role == 'Admin' || $u->role == 'Root') {
                    $redirectUrl = 'admin/admin.php';
                } elseif ($u->role == 'Member' && $u->status == 'Active') {
                    $redirectUrl = 'customer/customer.php';
                }

                login($u, $redirectUrl);
                exit();
            } else {
                // Incorrect password
                $failed_attempts = $u->failed_attempts + 1;
                $ban_duration = new DateInterval('PT1M'); // Ban for 3 minutes
                $banned_until = ($failed_attempts >= 3) ? $current_time->add($ban_duration)->format('Y-m-d H:i:s') : $u->banned_until;

                // Update user info with failed attempts and ban time
                $stm = $_db->prepare('
                    UPDATE user
                    SET failed_attempts = ?, banned_until = ?, last_failed_attempt = ?
                    WHERE email = ?
                ');
                $stm->execute([$failed_attempts, $banned_until, $current_time->format('Y-m-d H:i:s'), $email]);

                temp('info', ($failed_attempts > 3) ? 'Too many failed attempts. Account banned for 1 minutes.' : 'Incorrect password');
            }
        } else {
            temp('info', 'No such user');
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
                        <a href="requestReset.php">Forgot password?</a>
                    </label>
                </div>
                <button type="submit">Log in</button>
                <div class="register">
                    <p>Don't have an account? <a href="sendCode.php">Register</a></p>
                    <p>Need Recovery Account? <a href="sendRecoveryToken.php">Recovery</a></p>
                </div>
            </div>
        </div>
    </form>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>
