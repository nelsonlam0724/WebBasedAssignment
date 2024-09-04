<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}

// Check if ID is provided in the URL
if (!isset($_GET['user_id'])) {
    redirect('memberList.php');
}

$user_id = $_GET['user_id'];

// Fetch the member's details, including gender, birthday, and picture
$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_id]);
$member = $stm->fetch(PDO::FETCH_OBJ);

if (!$member) {
    redirect('memberList.php');
}

// Handle form submission
if (is_post()) {
    $new_email = req('email');
    $new_name = req('name');
    $new_role = req('role');
    $new_gender = req('gender');
    $new_birthday = req('birthday');
    $new_photo = $_FILES['photo'];

    // Update member's details
    $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, role = ?, gender = ?, birthday = ? WHERE user_id = ?');
    $stm->execute([$new_email, $new_name, $new_role, $new_gender, $new_birthday, $user_id]);

    // Handle picture upload
    if ($new_photo['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($new_photo['type'], $allowed_types)) {
            $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
        } else if ($new_photo['size'] > 2 * 1024 * 1024) { // 2MB max size
            $_err['photo'] = 'File size exceeds 2MB.';
        } else {
            $photo_name = save_photo_admin($new_photo);
            $stm = $_db->prepare('UPDATE user SET photo = ? WHERE user_id = ?');
            $stm->execute([$photo_name, $user_id]);
            $_SESSION['user']->photo = $photo_name;
        }
    }

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
    <form method="post" enctype="multipart/form-data" class="form">
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
        <label for="gender">Gender:</label>
        <select name="gender">
            <option value="Male" <?= $member->gender == 'Male' ? 'selected' : '' ?>>Male</option>
            <option value="Female" <?= $member->gender == 'Female' ? 'selected' : '' ?>>Female</option>
        </select>
        <br>
        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" value="<?= htmlspecialchars($member->birthday) ?>" required>
        <br>
        <label for="photo">Photo:</label>
        <input type="file" name="photo" accept="image/jpeg, image/png">
        <br>
        <?php if ($member->photo): ?>
            <img src="../uploads/<?= htmlspecialchars($member->photo) ?>" alt="Member photo" style="max-width: 150px;">
        <?php endif; ?>
        <br>
        <button type="submit">Update Member</button>
        <a href="memberList.php">Cancel</a>
    </form>
</body>
</html>
