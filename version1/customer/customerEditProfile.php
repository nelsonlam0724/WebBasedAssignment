<?php
include '../_base.php';
include '../_head.php';

auth('Admin', 'Member');

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
    } else if ($email !== $user->email) { // Check for uniqueness only if email has changed
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $emailCount = $stmt->fetchColumn();

        if ($emailCount > 0) {
            $_err['email'] = 'Email is already in use';
        }
    }

    // Validation: password and confirm
    if (!empty($password)) {
        // If password is provided, validate it
        if (strlen($password) < 5 || strlen($password) > 100) {
            $_err['password'] = 'Between 5-100 characters';
        }
        if ($confirm !== $password) {
            $_err['confirm'] = 'Passwords do not match';
        }
        // If no errors, hash the new password
        if (empty($_err['password']) && empty($_err['confirm'])) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }
    } else {
        // No new password provided, retain the current password
        $hashed_password = $user->password; // Assuming you store the hashed password in session
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
    if (!empty($photo['name']) && $photo['error'] === UPLOAD_ERR_OK) {
        // If a new file is uploaded, validate it
        if (!in_array($photo['type'], ['image/jpeg', 'image/png'])) {
            $_err['photo'] = 'Must be a JPEG or PNG';
        } else if ($photo['size'] > 1 * 1024 * 1024) {
            $_err['photo'] = 'Maximum 1MB';
        }
    } else {
        // No new photo uploaded, retain the current photo
        $photo_name = $user->photo;
    }

    if (empty($_err)) {
        // If a new photo was uploaded, save it and update $photo_name
        if (!empty($photo['name']) && $photo['error'] === UPLOAD_ERR_OK) {
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
            'photo' => $photo_name, // Update session with the new or existing photo
        ]);

        temp('info', 'Profile updated successfully');
        redirect('customer.php');
    }
}

$_title = 'Edit Customer Profile';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/profile.js"></script>
    <link rel="stylesheet" href="../css/profile.css">
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>

    <h1><?= htmlspecialchars($_title) ?></h1>

    <form method="post" class="form" enctype="multipart/form-data">
        <div class="form-container">
            <div class="form-left">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" maxlength="100" required value="<?= htmlspecialchars($user->email) ?>">
                    <?= err('email') ?>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" maxlength="100" required value="<?= htmlspecialchars($user->name) ?>">
                    <?= err('name') ?>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" maxlength="100" required>
                    <?= err('password') ?>
                </div>

                <div class="form-group">
                    <label for="confirm">Confirm Password:</label>
                    <input type="password" name="confirm" maxlength="100" required>
                    <?= err('confirm') ?>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" <?= $user->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $user->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= $user->gender == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                    <?= err('gender') ?>
                </div>
            </div>

            <div class="form-right">
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" name="birthday" required value="<?= htmlspecialchars($user->birthday) ?>">
                    <?= err('birthday') ?>
                </div>

                <label for="photo">Photo:</label>
                <div class="form-group upload">
                    <label class="upload">
                        <?= html_file('photo', 'image/*', 'hidden') ?>
                        <img src="../uploads/<?= htmlspecialchars($user->photo) ?>" alt="Profile Photo">
                    </label>

                    <?= err('photo') ?>
                </div>
            </div>
        </div>
        <button type="submit">Save Changes</button>
    </form>
    <div class="action-buttons">
        <a href="customerProfile.php"><button type="button">Back to Profile</button></a>
    </div>
</body>

</html>