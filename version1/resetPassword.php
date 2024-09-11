<?php
include '_base.php';
$email = $_SESSION['email']; // Retrieve email from session
if (empty($_SESSION['email']) || !$_SESSION['email']) {
    temp('info', 'You need to verify your email.');
    redirect('login.php');
    exit;
}

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
<link rel="stylesheet" href="css/resetPassword.css">
<link rel="stylesheet" href="css/simpleDesign.css">
<title><?= htmlspecialchars($_title) ?></title>
</head>

<body>
    <div class="form">
        <h1>Reset Password</h1>

        <?php if (isset($_err['general'])): ?>
            <p class="error"><?= htmlspecialchars($_err['general']) ?></p>
        <?php endif; ?>

        <form method="post">

            <label for="password">New Password</label>
            <?= html_password('password', 'maxlength="100"') ?>
            <?= err('password') ?>

            <label for="confirm">Confirm Password</label>
            <?= html_password('confirm', 'maxlength="100"') ?>
            <?= err('confirm') ?>

            <input type="hidden" name="email" value="<?= htmlspecialchars(req('email')) ?>">

            <section>
                <button type="submit">Reset Password</button>
                <button type="reset">Reset</button>
            </section>
        </form>
    </div>
    <div class="action-buttons">
        <a href="login.php"><button>Back to Login</button></a>
    </div>
</body>

</html>