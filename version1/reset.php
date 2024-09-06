<?php
include '_base.php';

// ----------------------------------------------------------------------------

if (is_post()) {
    $email = req('email');

    function generateVerificationCode() {
        return rand(100000, 999999);
    }
    
    $email = req('email');
    $verification_code = generateVerificationCode(); //
    
    $stmt = $_db->prepare('INSERT INTO token (email, verification_code, expire) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 15 MINUTE))');
    $stmt->execute([$email, $verification_code]);
    
    $m = get_mail();
    $m->addAddress($email);
    $m->isHTML(true);
    $m->Subject = 'Password Reset Verification Code';
    $m->Body = "
        <p>Dear user,</p>
        <p>Your password reset verification code is: <strong>$verification_code</strong></p>
        <p>Please enter this code on the website to reset your password.</p>
        <p>From, Admin</p>
    ";
    $m->send();
    

        temp('info', 'Email sent');
        redirect('resetPassword.php');
    }


// ----------------------------------------------------------------------------

$_title = 'User | Reset Password';
include '_head.php';
?>
<form method="post">
    <label for="password">New Password:</label>
    <input type="password" name="password" required>
    
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>
    
    <button type="submit">Reset Password</button>
</form>
<a href="login.php"><button>Back to Login</button></a>