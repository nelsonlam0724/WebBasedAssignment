<?php
include '../_base.php';
include '../_head.php';

auth('Root', 'Admin'); // Allow both Root and Admin to access

// Determine the logged-in user's role
$current_role = $_user->role;
$current_user_id = $_user->user_id;

// Handle form submission
if (is_post()) {
    $name = req('name');
    $email = req('email');
    $password = req('password');
    $confirm = req('confirm');
    $f = get_file('photo');
    $gender = req('gender');
    $birthday = req('birthday');

    // Set role based on the logged-in user
    if ($current_user_role === 'Root') {
        $role = req('role'); // Root can select the role
    } else {
        $role = 'Member'; // Admin can only register members
    }

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
        } else {
            $input_date = new DateTime($birthday);
            $today = new DateTime();  // Today's date

            $input_date->setTime(0, 0, 0);
            $today->setTime(0, 0, 0);

            if ($input_date > $today) {
                $_err['birthday'] = 'Date must be before today';
            }
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

    $user_id = generateID('user', 'user_id', 'U', 4);

    // DB operation
    if (!$_err) {
        $photo = save_photo_admin($f);

        $stm = $_db->prepare('
            INSERT INTO user (user_id, email, password, name, gender, birthday, photo, role, status)
            VALUES (?, ?, SHA1(?), ?, ?, ?, ?, ?, "Active")
        ');
        $stm->execute([$user_id, $email, $password, $name, $gender, $birthday, $photo, $role]);

        temp('info', 'Record inserted');
        redirect();
    }
}

$_title = 'Register User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/image.css">
    <script src="../js/profile.js"></script>
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Register New User</h1>
    <?php if (isset($_err['general'])): ?>
        <p class="error"><?= htmlspecialchars($_err['general']) ?></p>
    <?php endif; ?>
    <form method="post" class="form" enctype="multipart/form-data">
        <div class="form-container">
            <div class="form-left">
                <label for="name">Name:</label>
                <?= html_text('name', 'maxlength="100"') ?>
                <?= err('name') ?>

                <label for="email">Email:</label>
                <?= html_text('email', 'maxlength="100"') ?>
                <?= err('email') ?>
                <br>

                <label for="password">Password:</label>
                <?= html_password('password', 'maxlength="100"') ?>
                <?= err('password') ?>

                <label for="confirm">Confirm Password:</label>
                <?= html_password('confirm', 'maxlength="100"') ?>
                <?= err('confirm') ?>

                <label for="gender">Gender:</label>
                <?php
                $genderOptions = [
                    '' => 'Select Gender',
                    'Male' => 'Male',
                    'Female' => 'Female'
                ];
                html_select('gender', $genderOptions);
                ?>
                <?= err('gender') ?>
            </div>
            <div class="form-right">
                <label for="birthday">Birthday:</label>
                <?= html_date('birthday', 'required') ?>
                <?= err('birthday') ?>

                <?php if ($current_role == 'Root'): ?>
                    <label for="role">Role:</label>
                    <?php
                    $roleOptions = [
                        'Member' => 'Member',
                        'Admin' => 'Admin'
                    ];
                    html_select('role', $roleOptions);
                    ?>
                    <?= err('role') ?>

                <?php else: ?>
                    <input type="hidden" name="role" value="Member">
                <?php endif; ?>

                <label for="photo">Photo:</label>
                <label class="upload">
                    <?= html_file('photo', 'image/*', 'hidden') ?>
                    <img src="../images/photo.jpg" alt="Profile Photo">
                </label>
                <?= err('photo') ?>
            </div>
        </div>
        <section class="form-actions">
            <button type="submit">Register</button>
            <button type="reset">Reset</button>
        </section>
    </form>
    <div class="action-buttons">
        <a href="userList.php"><button>Back to User List</button></a>
    </div>
</body>

</html>