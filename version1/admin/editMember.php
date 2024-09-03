<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE id = ?');
    $stm->execute([$_user->id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}

// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    redirect('memberList.php');
}

$id = $_GET['id'];

// Fetch the member's details
$stm = $_db->prepare('SELECT * FROM user WHERE id = ?');
$stm->execute([$id]);
$member = $stm->fetch(PDO::FETCH_OBJ);

if (!$member) {
    redirect('memberList.php');
}

// Handle form submission
if (is_post()) {
    $new_email = req('email');
    $new_name = req('name');
    $new_role = req('role');

    // Update member's details
    $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, role = ? WHERE id = ?');
    $stm->execute([$new_email, $new_name, $new_role, $id]);

    temp('info', 'Member updated successfully');
    redirect('memberList.php');
}

$_title = 'Edit Member';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>
<body>
    <h1>Edit Member</h1>
    <form method="post" class="form">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($member->email) ?>" required maxlength="100">
        <br>
        <label for="name">Username:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($member->name) ?>" required maxlength="100">
        <br>
        <label for="role">Role:</label>
        <select name="role">
            <option value="Member" <?= $member->role == 'Member' ? 'selected' : '' ?>>Member</option>
            <option value="Admin" <?= $member->role == 'Admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <br>
        <button type="submit">Update Member</button>
        <button><a href="memberList.php">Cancel</a></button>
    </form>
</body>
</html>
