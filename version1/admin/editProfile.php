<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if ($u->role !="Admin") {
        redirect('../login.php');
    }
    
}
$user = $_SESSION['user'];

// Initialize error array
$_err = [];

if (is_post()) {
    // Capture and validate input
    $email = req('email');
    $name = req('name');
    $password = req('password');
    $confirm = req('confirm');
    $birthday = req('birthday');
    $gender = req('gender');
    $photo = $_FILES['photo'];

    // Validation: email
    if (!$email) {
        $_err['email'] = 'Required';
    } else if (strlen($email) > 100) {
        $_err['email'] = 'Maximum 100 characters';
    } else if (!is_email($email)) {
        $_err['email'] = 'Invalid email';
    } else if (!is_unique($email, 'user', 'email')) {
        $_err['email'] = 'Duplicated';
    }

    // Validation: password and confirm
    if (!$password) {
        $_err['password'] = 'Required';
    } else if (strlen($password) < 5 || strlen($password) > 100) {
        $_err['password'] = 'Between 5-100 characters';
    }
    if (!$confirm) {
        $_err['confirm'] = 'Required';
    } else if ($confirm != $password) {
        $_err['confirm'] = 'Passwords do not match';
    }

    // Validation: name
    if (!$name) {
        $_err['name'] = 'Required';
    } else if (strlen($name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
    }

    // Validation: birthday
    if (!$birthday) {
        $_err['birthday'] = 'Required';
    } else if (!is_birthday($birthday)) {
        $_err['birthday'] = 'Invalid date format';
    }

    // Validation: gender
    if (!$gender) {
        $_err['gender'] = 'Required';
    } else if (!is_gender($gender)) {
        $_err['gender'] = 'Invalid gender';
    }

    // Validation: photo (file)
    if (!isset($photo['name']) || $photo['error'] === UPLOAD_ERR_NO_FILE) {
        $_err['photo'] = 'Required';
    } else if (!in_array($photo['type'], ['image/jpeg', 'image/png'])) {
        $_err['photo'] = 'Must be a JPEG or PNG';
    } else if ($photo['size'] > 1 * 1024 * 1024) {
        $_err['photo'] = 'Maximum 1MB';
    }

    if (empty($_err)) {
        // Update password hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Photo handling
        $photo_name = $user->photo; // Default to existing photo
        if ($photo['error'] === UPLOAD_ERR_OK) {
            $photo_name = save_photo_admin($photo);
        }

        // Update query with photo
        $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, password = ?, birthday = ?, gender = ?, photo = ? WHERE user_id = ?');
        $stm->execute([$email, $name, $hashed_password, $birthday, $gender, $photo_name, $user->user_id]);

        // Update session data
        $_SESSION['user'] = (object) array_merge((array)$_SESSION['user'], [
            'email' => $email,
            'name' => $name,
            'birthday' => $birthday,
            'gender' => $gender,
            'photo' => $photo_name,
        ]);

        temp('info', 'Profile updated successfully');
        redirect('admin.php');
    }
}

$_title = 'Edit Admin Profile';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/profile.js"></script>
    <link rel="stylesheet" href="../css/image.css">
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>

    <h1><?= htmlspecialchars($_title) ?></h1>

    <form method="post" class="form" enctype="multipart/form-data">
        <label for="email">Email:</label><br>
        <?= html_text('email', 'maxlength="100" required') ?>
        <?= err('email') ?>
        <br>

        <label for="name">Name:</label><br>
        <?= html_text('name', 'maxlength="100" required') ?>
        <?= err('name') ?>
        <br>

        <label for="password">Password</label><br>
        <?= html_password('password', 'maxlength="100" required') ?>
        <?= err('password') ?>
        <br>

        <label for="confirm">Confirm</label><br>
        <?= html_password('confirm', 'maxlength="100" required') ?>
        <?= err('confirm') ?>
        <br>
        <label for="gender">Gender</label><br>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <?= err('gender') ?>
        <br>

        <label for="birthday">Birthday</label><br>
        <?= html_text('birthday', 'placeholder="YYYY-MM-DD"') ?>
        <?= err('birthday') ?>
        <br>

        <label for="photo">Photo</label><br>
        <label class="upload">
            <?= html_file('photo', 'image/*', 'hidden') ?>
            <img src="../uploads/<?= $_user->photo ?>" width="170" height="170">
        </label>
        <?= err('photo') ?>
        <br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="profile.php"><button>Back to Profile</button></a>
</body>

</html>