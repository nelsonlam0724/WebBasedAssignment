<?php
include '_base.php';

// Handle POST request for password reset
if (is_post()) {
    $email = req('email');

    // Validate email
    if ($email == '' || !is_email($email) || !is_exists($email, 'user', 'email')) {
        temp('info', 'Invalid email address.');
        redirect('/');
    }

    // Generate a random 6-digit verification code
    $verification_code = rand(100000, 999999);

    // Store the code and expiration in the database
    $stmt = $_db->prepare('
        INSERT INTO token (verification_code, email, expire) 
        VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))
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
        <p>This code will expire in 15 minutes.</p>
    ";
    $m->send();

    temp('info', 'Verification code sent.');
    redirect('verifyCode.php');
}

$_title = 'Request Password Reset';
include '_head.php';
?>

<form method="post" class="form">
    <label for="email">Email</label>
    <?= html_text('email', 'maxlength="100"') ?>
    <?= err('email') ?>

    <section>
        <button>Submit</button>
        <button type="reset">Reset</button>
    </section>
</form>
<a href="login.php"><button>Back to Login</button></a>