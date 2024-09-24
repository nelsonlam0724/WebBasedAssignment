<?php

$user_id = $_SESSION['user']->user_id; 
$order = $_SESSION['order_id'];
$_err = [];

if (is_post()) {
    $entered_pin = req('eWallet');

    // Fetch the stored PIN for the user
    $stm = $_db->prepare('SELECT PIN FROM wallet WHERE user_id = ? LIMIT 1');
    $stm->execute([$user_id]);
    $wallet = $stm->fetch();

    // Validate PIN input
    if (!$entered_pin) {
        $_err['eWallet'] = '**PIN number is required';
    } else if (!preg_match('/^\d{6}$/', $entered_pin)) {
        $_err['eWallet'] = '**PIN number must be exactly 6 digits';
    }

    // If no errors, proceed with PIN matching
    if (!$_err) {
        if ($wallet === false) {
            $_err['eWallet'] = 'Invalid PIN number. Please try again.';
        } else {
            // Update payment record and order status on successful PIN validation
            $stm = $_db->prepare('UPDATE `payment_record` SET datetime = NOW() WHERE order_id = ?');
            $stm->execute([$order]);

            $stm = $_db->prepare('UPDATE `orders` SET status = ? WHERE id = ?');
            $stm->execute(["Paid", $order]);

            // Redirect to the thank you page
            redirect("../message/thanks.php");
        }
    }
}
?>

<form id="PIN-form" method="post">
    <div class="form-group">
        <label for="wallet">E-Wallet <span style="color:red;"><?= err('eWallet') ?></span></label>
        <?= html_text('eWallet', 'placeholder="Please Enter Your PIN here"') ?>
    </div>
    <div style="display:flex;gap:20px;">
        <div class="button">
            <button>Pay →</button>
        </div>
        <div class="button">
        <a href="../customer/customer.php" style="display: inline-block; padding: 10px 20px; background-color:black; color: white; text-align: center; text-decoration: none; border-radius: 5px; font-size: 16px;">
  <div>Later</div>
</a>

        </div>
    </div>
</form>
