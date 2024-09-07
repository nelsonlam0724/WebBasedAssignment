<?php
include '_base.php';

if (is_post()) {
    $email = req('email');

    // Check if account is deactivated
    $stm = $_db->prepare('SELECT * FROM user WHERE email = ?');
    $stm->execute([$email]);
    $user = $stm->fetch(PDO::FETCH_OBJ);

    if ($user && $user->status == 'Deactivate') {
        // Generate a random 6-digit verification code
        $verification_code = rand(100000, 999999);

        // Store the code and expiration in the database
        $stmt = $_db->prepare('
                INSERT INTO token (verification_code, email, expire) 
                VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))
                ON DUPLICATE KEY UPDATE 
                verification_code = VALUES(verification_code), 
                expire = VALUES(expire)
            ');
        $stmt->execute([$verification_code, $email]);

        // Send email with the verification code
        $m = get_mail();
        $m->addAddress($email);
        $m->isHTML(true);
        $m->Subject = 'Account Recovery Verification';
        $m->Body = "
            <p>Here is your verification code: <strong>$verification_code</strong></p>
            <p>This code will expire in 15 minutes.</p>
        ";

        try {
            $m->send();
            temp('info', 'Verification code sent.');
            $_SESSION['email'] = $email; // Store the email in session
            redirect('verifyRecoveryCode.php');
        } catch (Exception $e) {
            temp('info', 'Failed to send verification email: ' . $m->ErrorInfo);
            redirect('sendRecoveryToken.php');
        }
    } else {
        // If account is not deactivated, show an error message
        temp('info', 'This email address is not associated with a deactivated account.');
        redirect('sendRecoveryToken.php');
    }
}

$_title = 'Request Account Recovery Verification';
include '_head.php';
?>
<link rel="stylesheet" href="css/simpleDesign.css">
<h1><?= $_title ?></h1>
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
    <a href="login.php"><button>Back to Login</button></a>
</div>
