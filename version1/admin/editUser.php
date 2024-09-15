<?php
include '../_base.php';
include '../_head.php';

auth('Root', 'Admin');

// Check if ID is provided in the URL
if (!isset($_GET['user_id'])) {
    redirect('userList.php');
}

$user_id = $_GET['user_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch the user's details
$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_id]);
$user = $stm->fetch(PDO::FETCH_OBJ);

if (!$user) {
    redirect('userList.php');
}

// Determine the current user's role
$current_role = $_SESSION['user']->role;
$current_user_id = $_SESSION['user']->user_id;

// Handle form submission
if (is_post()) {
    // Capture and validate input
    $new_email = req('email');
    $new_name = req('name');
    $new_role = req('role');
    $new_gender = req('gender');
    $new_birthday = req('birthday');
    $new_photo = $_FILES['photo'];
    $new_status = req('status');
    $password = req('password');
    $confirm_password = req('confirm');

    // Validation: email
    if (!$new_email) {
        $_err['email'] = 'Required';
    } else if (!is_email($new_email)) {
        $_err['email'] = 'Invalid email';
    }

    // Validation: name
    if (!$new_name) {
        $_err['name'] = 'Required';
    }

    // Validate: birthday
    if (!$new_birthday) {
        $_err['birthday'] = 'Required';
    } else if (!is_birthday($new_birthday)) {
        $_err['birthday'] = 'Invalid date format';
    } else {
        $birthdate_parts = explode('-', $new_birthday);
        if (!checkdate($birthdate_parts[1], $birthdate_parts[2], $birthdate_parts[0])) {
            $_err['birthday'] = 'Invalid date';
        } else {
            $input_date = new DateTime($new_birthday);
            $today = new DateTime();  // Today's date

            // Set the time of both dates to the start of the day to ensure accurate comparison
            $input_date->setTime(0, 0, 0);
            $today->setTime(0, 0, 0);

            if ($input_date > $today) {
                $_err['birthday'] = 'Date must be before today';
            }
        }
    }

    // Password validation
    if (!empty($password)) {
        if ($password !== $confirm_password) {
            $_err['password'] = 'Passwords do not match';
        } else if (strlen($password) < 5 || strlen($password) > 100) {
            $_err['password'] = 'Password must be between 5 and 100 characters';
        } else {
            // Hash new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }
    } else {
        // Retain the current password
        $hashed_password = $user->password;
    }

    // Photo handling
    if ($new_photo['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($new_photo['type'], $allowed_types)) {
            $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
        } else if ($new_photo['size'] > 2 * 1024 * 1024) { // 2MB max size
            $_err['photo'] = 'File size exceeds 2MB.';
        } else {
            $photo_name = save_photo_admin($new_photo);
        }
    } else {
        $photo_name = $user->photo; // Retain the existing photo
    }

    // Check if current user is trying to edit their own details
    $is_editing_self = $user_id == $current_user_id;

    // If no errors, update the database
    if (empty($_err)) {
        // Additional check before updating
        if ($current_role == 'Root' && $is_editing_self && $new_status == 'Banned') {
            temp('info', 'You cannot banned yourself.');
        } else {
            $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, password = ?, role = ?, gender = ?, birthday = ?, photo = ?, status = ? WHERE user_id = ?');
            $stm->execute([$new_email, $new_name, $hashed_password, $new_role, $new_gender, $new_birthday, $photo_name, $new_status, $user_id]);

            temp('info', 'User updated successfully');
            redirect('userList.php');
        }
    }
}

$_title = 'Edit User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <script src="../js/profile.js"></script>
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>
    <h1>Edit User</h1>
    <form method="post" enctype="multipart/form-data" class="form">
        <div class="form-container">
            <div class="form-left">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->email) ?>" required maxlength="100">
                    <?= isset($_err['email']) ? "<span class='error'>{$_err['email']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($user->name) ?>" required maxlength="100">
                    <?= isset($_err['name']) ? "<span class='error'>{$_err['name']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" maxlength="100" placeholder="Leave blank to keep current password">
                    <?= isset($_err['password']) ? "<span class='error'>{$_err['password']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <label for="confirm">Confirm Password:</label>
                    <input type="password" name="confirm" id="confirm" maxlength="100" placeholder="Leave blank to keep current password">
                    <?= isset($_err['confirm']) ? "<span class='error'>{$_err['confirm']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <?php if ($current_role == 'Root' && $user_id == $current_user_id): ?>
                        <label for="role">Role:</label>
                        <input type="text" name="role" id="role" value="<?= htmlspecialchars($user->role) ?>" readonly>
                    <?php elseif ($current_role == 'Root'): ?>
                        <label for="role">Role:</label>
                        <select name="role" id="role">
                            <option value="Admin" <?= $user->role == 'Admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="Member" <?= $user->role == 'Member' ? 'selected' : '' ?>>Member</option>
                        </select>
                    <?php elseif ($current_role == 'Admin'): ?>
                        <label for="role">Role:</label>
                        <input type="text" name="role" id="role" value="<?= htmlspecialchars($user->role) ?>" readonly>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender">
                        <option value="Male" <?= $user->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $user->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                    <?= isset($_err['gender']) ? "<span class='error'>{$_err['gender']}</span>" : '' ?>
                </div>
            </div>

            <div class="form-right">
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="Active" <?= $user->status == 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Banned" <?= $user->status == 'Banned' ? 'selected' : '' ?>>Banned</option>
                    </select>
                    <?= isset($_err['status']) ? "<span class='error'>{$_err['status']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" name="birthday" id="birthday" value="<?= htmlspecialchars($user->birthday) ?>" required>
                    <?= isset($_err['birthday']) ? "<span class='error'>{$_err['birthday']}</span>" : '' ?>
                </div>

                <label for="photo">Photo:</label>
                <div class="form-group upload">
                    <label class="upload">
                        <?= html_file('photo', 'image/*', 'hidden') ?>
                        <img src="../uploads/<?= htmlspecialchars($user->photo) ?>" alt="Profile Photo">
                    </label>
                    <?= isset($_err['photo']) ? "<span class='error'>{$_err['photo']}</span>" : '' ?>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Update User</button>
            <a href="userList.php"><button>Cancel</button></a>
        </div>
    </form>
</body>

</html>