<?php
include '_base.php';

// Handle POST request for password reset
if (is_post()) {
    $email = req('email');

    // Validate email
    if ($email == '' || !is_email($email) || !is_exists($email, 'user', 'email')) {
        temp('info', 'This email address havent register as our website member.');
        redirect();
    }

    // Generate a random 6-digit verification code
    $verification_code = rand(100000, 999999);

    // Store the code and expiration in the database
    $stmt = $_db->prepare('
        INSERT INTO token (verification_code, email, expire) 
        VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 MINUTE))
        ON DUPLICATE KEY UPDATE 
        email = VALUES(email), 
        expire = VALUES(expire)
    ');
    $stmt->execute([$verification_code, $email]);

    // Send email with the verification code
    $m = get_mail();
    $m->addAddress($email);
    $m->isHTML(true);
    $m->Subject = 'Password Reset Request';
    $m->Body = "
        <p>Here is your verification code: <strong>$verification_code</strong></p>
        <p>This code will expire in 1 minutes.</p>
    ";
    try {
        $m->send();
        temp('info', 'Verification code sent.');
    } catch (Exception $e) {
        temp('info', 'Failed to send verification email: ' . $m->ErrorInfo);
        redirect();
    }
    $_SESSION['email'] = $email; // Store the email in session
    redirect('verifyCode.php');
}

$_title = 'Request Password Reset';
include '_head.php';
?>
<link rel="stylesheet" href="css/simpleDesign.css">
<h1><?= $_title?></h1>
<form method="post" class="form">
    <label for="email">Email</label>
    <?= html_text('email', 'maxlength="100"') ?>
    <?= err('email') ?>

    <section class="form-buttons">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="reset-btn">Reset</button>
    </section>
</form>
<div class="action-buttons">
    <a href="logout.php"><button>Back to Login</button></a>
</div>