<?php
include '_base.php';

// Handle POST request for password reset
if (is_post()) {
    $password = req('password');
    $confirm  = req('confirm');
    $email = req('email');

    // Validate password
    if ($password == '' || strlen($password) < 5 || strlen($password) > 100) {
        $_err['password'] = 'Password must be between 5 and 100 characters.';
    }

    // Validate confirmation
    if ($confirm == '' || strlen($confirm) < 5 || strlen($confirm) > 100 || $confirm != $password) {
        $_err['confirm'] = 'Passwords do not match.';
    }

    // DB operation
    if (!$_err) {
        // Update user password and delete token
        $stmt = $_db->prepare('
            UPDATE user
            SET password = SHA(?)
            WHERE email = ?;

            DELETE FROM token WHERE email = ?;
        ');
        $stmt->execute([$password, $email, $email]);

        temp('info', 'Password updated successfully.');
        redirect('login.php');
    }
}

$_title = 'Reset Password';
include '_head.php';
?>

<form method="post" class="form">
    <label for="password">New Password</label>
    <?= html_password('password', 'maxlength="100"') ?>
    <?= err('password') ?>
    <br>
    <label for="confirm">Confirm Password</label>
    <?= html_password('confirm', 'maxlength="100"') ?>
    <?= err('confirm') ?>
    <br>
    <input type="hidden" name="email" value="<?= htmlspecialchars(req('email')) ?>">

    <section>
        <button>Reset Password</button>
        <button type="reset">Reset</button>
    </section>
</form>
<a href="login.php"><button>Back to Login</button></a>