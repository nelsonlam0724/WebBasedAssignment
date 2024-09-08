<?php
include '../_base.php';
include '../_head.php';

auth('Admin','Member');

$user = $_SESSION['user'];

if (is_post()) {
    $deactivated_at = date('Y-m-d H:i:s'); // Get current time
    $stm = $_db->prepare('UPDATE user SET status = ?, deactivated_at = ? WHERE user_id = ?');
    $result = $stm->execute(['Deactivate', $deactivated_at, $user->user_id]);

    // Run cleanup function after deactivation
    $cleanup_stm = $_db->prepare('UPDATE user SET status = ? WHERE status = ? AND deactivated_at <= (NOW() - INTERVAL 1 MINUTE)');
    $cleanup_stm->execute(['Banned', 'Deactivate']);
    
    // Logout user and destroy session
    session_unset();
    session_destroy();
    temp('info', 'Your account has been deactivated. You can recover it within 1 minute.');
    redirect('../login.php');
}

$_title = 'Deactivate Account';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>

    <h1><?= htmlspecialchars($_title) ?></h1>

    <form method="post" class="form">
        <div class="form-container">
            <p>Are you sure you want to deactivate your account? This action cannot be undone,
                and you will not be able to log in again unless an administrator reactivates your account within 24 hours.</p>
        </div>
        <button type="submit" class="btn-deactivate">Yes, Deactivate My Account</button>
    </form>

    <div class="action-buttons">
        <a href="customerProfile.php"><button type="button">Back to Profile</button></a>
    </div>

</body>

</html>
