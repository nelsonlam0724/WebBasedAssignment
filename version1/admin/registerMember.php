<?php
include '../_base.php';
include '../_head.php';

// Handle form submission
if (is_post()) {
    $name = req('name');
    $email = req('email');
    $password = req('password');
    $confirm = req('confirm');
    $f = get_file('photo');
    $gender = req('gender');
    $birthday = req('birthday');

    // Validate: email
    if (!$email) {
        $_err['email'] = 'Required';
    } else if (strlen($email) > 100) {
        $_err['email'] = 'Maximum 100 characters';
    } else if (!is_email($email)) {
        $_err['email'] = 'Invalid email';
    } else if (!is_unique($email, 'user', 'email')) {
        $_err['email'] = 'Duplicated';
    }

    // Validate: password
    if (!$password) {
        $_err['password'] = 'Required';
    } else if (strlen($password) < 5 || strlen($password) > 100) {
        $_err['password'] = 'Between 5-100 characters';
    }

    // Validate: confirm
    if (!$confirm) {
        $_err['confirm'] = 'Required';
    } else if (strlen($confirm) < 5 || strlen($confirm) > 100) {
        $_err['confirm'] = 'Between 5-100 characters';
    } else if ($confirm != $password) {
        $_err['confirm'] = 'Not matched';
    }

    // Validate: name
    if (!$name) {
        $_err['name'] = 'Required';
    } else if (strlen($name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
    }

    // Validate: gender
    if (!$gender) {
        $_err['gender'] = 'Required';
    } else if (!is_gender($gender)) {
        $_err['gender'] = 'Invalid gender';
    }

    // Validate: birthday
    if (!$birthday) {
        $_err['birthday'] = 'Required';
    } else if (!is_birthday($birthday)) {
        $_err['birthday'] = 'Invalid date format';
    } else {
        $birthdate_parts = explode('-', $birthday);
        if (!checkdate($birthdate_parts[1], $birthdate_parts[2], $birthdate_parts[0])) {
            $_err['birthday'] = 'Invalid date';
        }
    }

    // Validate: photo (file)
    if (!$f) {
        $_err['photo'] = 'Required';
    } else if (!str_starts_with($f->type, 'image/')) {
        $_err['photo'] = 'Must be an image';
    } else if ($f->size > 1 * 1024 * 1024) {
        $_err['photo'] = 'Maximum 1MB';
    }

    // DB operation
    if (!$_err) {
        $photo = save_photo($f);

        $stm = $_db->prepare('
            INSERT INTO user (email, password, name, gender, birthday, photo, role)
            VALUES (?, SHA1(?), ?, ?, ?, ?, "Member")
        ');
        $stm->execute([$email, $password, $name, $gender, $birthday, $photo]);

        temp('info', 'Record inserted');
        redirect();
    }
}

$_title = 'Register Member';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/image.css">
    <script src="../js/profile.js"></script>
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Register New Member</h1>
    <?php if (isset($_err['general'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_err['general']) ?></p>
    <?php endif; ?>
    <form method="post" class="form" enctype="multipart/form-data">
        <label for="name">Name</label><br>
        <?= html_text('name', 'maxlength="100"') ?>
        <?= err('name') ?>
        <br>

        <label for="email">Email</label><br>
        <?= html_text('email', 'maxlength="100"') ?>
        <?= err('email') ?>
        <br>

        <label for="password">Password</label><br>
        <?= html_password('password', 'maxlength="100"') ?>
        <?= err('password') ?>
        <br>

        <label for="confirm">Confirm</label><br>
        <?= html_password('confirm', 'maxlength="100"') ?>
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
        <input type="date" name="birthday" required>
        <?= err('birthday') ?>
        <br>

        <label for="photo">Photo</label>
        <label class="upload">
            <?= html_file('photo', 'image/*', 'hidden') ?>
            <img src="../images/photo.jpg">
        </label>
        <?= err('photo') ?>
        <br>

        <button type="submit">Register</button>
    </form>
    <p>Back to Menu <a href="admin.php">Back</a></p>
</body>

</html>