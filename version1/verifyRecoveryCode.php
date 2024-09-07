<?php
include '_base.php';

// Handle POST request for code verification
if (is_post()) {
    $input_code = req('code');

    // Retrieve the stored verification code and check expiration
    $stmt = $_db->prepare('
        SELECT email
        FROM token
        WHERE verification_code = ? AND expire > NOW()
    ');
    $stmt->execute([$input_code]);

    $email = $stmt->fetchColumn();

    if ($email) {
        // Reactivate the account
        $stm = $_db->prepare('UPDATE user SET status = ?, deactivated_at = NULL WHERE email = ?');
        $stm->execute(['Active', $email]);

        temp('info', 'Your account has been successfully reactivated. You can now log in.');
        redirect('login.php');
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
    <a href="login.php"><button>Back to Login</button></a>
</div>
