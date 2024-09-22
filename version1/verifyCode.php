<?php
include '_base.php';
$email = $_SESSION['email']; // Retrieve email from session
if (empty($_SESSION['email']) || !$_SESSION['email']) {
    temp('info', 'You need to verify your email.');
    redirect('login.php');
    exit;
}

// Handle POST request for code verification
if (is_post()) {
    $input_code = req('code');

    // Retrieve the stored verification code and its expiration
    $stmt = $_db->prepare('
        SELECT email
        FROM token
        WHERE verification_code = ? AND expire > NOW()
    ');
    $stmt->execute([$input_code]);

    $email = $stmt->fetchColumn();

    // Debug output for troubleshooting
    echo "Input Code: $input_code<br>";
    echo "Email: $email<br>";

    // Verify the code
    if ($email) {
        // Code is correct; proceed to password reset
        temp('info', 'You can reset your password now.');
        header('Location: resetPassword.php?email=' . urlencode($email));
        exit;
    } else {
        temp('info', 'Verification code is incorrect or expired.');
    }
}

$_title = 'Verify Code';
include '_head.php';
?>
<link rel="stylesheet" href="css/simpleDesign.css">

<h1><?= $_title ?></h1>
<form method="post" class="form">
    <label for="code">Enter the 6-digit verification code:</label>
    <?= html_text('code', 'maxlength="6"') ?>
    <?= err('code') ?>

    <section>
        <button type="submit">Verify</button>
        <button type="reset">Reset</button>
    </section>
</form>

<div class="action-buttons">
    <a href="logout.php"><button>Back to Login</button></a>
</div>