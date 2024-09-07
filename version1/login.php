<?php
include '_base.php';
include '_head.php';
// ----------------------------------------------------------------------------


$cleanup_stm = $_db->prepare('UPDATE user SET status = ? WHERE status = ? AND deactivated_at <= (NOW() - INTERVAL 1 MINUTE)');
$cleanup_stm->execute(['Banned', 'Deactivate']);

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
                    temp('info', 'Your account is deactivated. Please wait ' . $remaining_interval->i . ' minutes before reactivation.');
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
                temp('info', 'Your account is banned. Try again after ' . $remaining_ban_time->i . ' minutes.');
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

            // Check frequent login/logouts
            if ($u->last_login_event_time) {
                $last_event_time = new DateTime($u->last_login_event_time);
                $diff_minutes = $current_time->diff($last_event_time)->i;

                if ($diff_minutes < 1 && $u->login_count >= 3) {
                    temp('info', 'Frequent login attempts detected. Please wait 2 minutes before trying again.');
                    redirect();
                } else if ($diff_minutes >= 1) {
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

                temp('info', 'Login successfully');
                if ($u->role == 'Admin') {
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

                temp('info', ($failed_attempts >= 3) ? 'Too many failed attempts. Account banned for 1 minutes.' : 'Incorrect password');
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
<!-- Footer -->
<?php
include '_foot.php';
?>