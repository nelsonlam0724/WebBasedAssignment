<?php
include '../_base.php';
include '../_head.php';

// Fetch user data if GET request
if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if (!$u) {
        redirect('../login.php');
    }
}

$user = $_SESSION['user'];

// Initialize error array
$_err = [];

// Handle form submission (POST request)
if (is_post()) {
    $update_part = req('update_part'); // Determine if the update is partial or full
    $update_all = req('update_all');   // Determine if the update is for all fields

    // Handle Partial Updates
    if ($update_part) {
        $field = req('field');
        $value = req('value');

        switch ($field) {
            case 'email':
                if (strlen($value) > 100) {
                    $_err['email'] = 'Maximum 100 characters';
                } else if (!is_email($value)) {
                    $_err['email'] = 'Invalid email';
                } else if (!is_unique($value, 'user', 'email')) {
                    $_err['email'] = 'Duplicated';
                } else {
                    $stm = $_db->prepare('UPDATE user SET email = ? WHERE user_id = ?');
                    $stm->execute([$value, $user->user_id]);
                    $_SESSION['user']->email = $value;
                }
                break;

            case 'name':
                if (strlen($value) > 100) {
                    $_err['name'] = 'Maximum 100 characters';
                } else {
                    $stm = $_db->prepare('UPDATE user SET name = ? WHERE user_id = ?');
                    $stm->execute([$value, $user->user_id]);
                    $_SESSION['user']->name = $value;
                }
                break;

            case 'password':
                if (strlen($value) < 5 || strlen($value) > 100) {
                    $_err['password'] = 'Between 5-100 characters';
                } else {
                    $hashed_password = password_hash($value, PASSWORD_DEFAULT);
                    $stm = $_db->prepare('UPDATE user SET password = ? WHERE user_id = ?');
                    $stm->execute([$hashed_password, $user->user_id]);
                }
                break;

            case 'birthday':
                if (!is_birthday($value)) {
                    $_err['birthday'] = 'Invalid date format';
                } else {
                    $stm = $_db->prepare('UPDATE user SET birthday = ? WHERE user_id = ?');
                    $stm->execute([$value, $user->user_id]);
                    $_SESSION['user']->birthday = $value;
                }
                break;

            case 'gender':
                if (!is_gender($value)) {
                    $_err['gender'] = 'Invalid gender';
                } else {
                    $stm = $_db->prepare('UPDATE user SET gender = ? WHERE user_id = ?');
                    $stm->execute([$value, $user->user_id]);
                    $_SESSION['user']->gender = $value;
                }
                break;

            case 'role':
                $stm = $_db->prepare('UPDATE user SET role = ? WHERE user_id = ?');
                $stm->execute([$value, $user->user_id]);
                $_SESSION['user']->role = $value;
                break;

            case 'photo':
                $photo = $_FILES['value'];
                $allowed_types = ['image/jpeg', 'image/png'];
                if (!in_array($photo['type'], $allowed_types)) {
                    $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
                } else if ($photo['size'] > 2 * 1024 * 1024) { // 2MB max size
                    $_err['photo'] = 'File size exceeds 2MB.';
                } else {
                    $photo_name = save_photo_admin($photo);
                    $stm = $_db->prepare('UPDATE user SET photo = ? WHERE user_id = ?');
                    $stm->execute([$photo_name, $user->user_id]);
                    $_SESSION['user']->photo = $photo_name;
                }
                break;
        }

        if (empty($_err)) {
            temp('info', 'Profile updated successfully');
            redirect('admin.php');
        }
    }

    // Handle Full Updates
    if ($update_all) {
        $email = req('email');
        $name = req('name');
        $password = req('password');
        $birthday = req('birthday');
        $gender = req('gender');
        $role = req('role');
        $photo = $ge['photo'];

        // Validate and update all fields
        if (strlen($email) > 100) {
            $_err['email'] = 'Maximum 100 characters';
        } else if (!is_email($email)) {
            $_err['email'] = 'Invalid email';
        } else if (!is_unique($email, 'user', 'email')) {
            $_err['email'] = 'Duplicated';
        }

        if (strlen($name) > 100) {
            $_err['name'] = 'Maximum 100 characters';
        }

        if (strlen($password) < 5 || strlen($password) > 100) {
            $_err['password'] = 'Between 5-100 characters';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!is_birthday($birthday)) {
            $_err['birthday'] = 'Invalid date format';
        }

        if (!is_gender($gender)) {
            $_err['gender'] = 'Invalid gender';
        }

        if (empty($_err)) {
            // Update all fields
            $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, password = ?, birthday = ?, gender = ?, role = ? WHERE user_id = ?');
            $stm->execute([$email, $name, $hashed_password, $birthday, $gender, $role, $user->user_id]);

            if ($photo['error'] === UPLOAD_ERR_OK) {
                $allowed_types = ['image/jpeg', 'image/png'];
                if (!in_array($photo['type'], $allowed_types)) {
                    $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
                } else if ($photo['size'] > 2 * 1024 * 1024) { // 2MB max size
                    $_err['photo'] = 'File size exceeds 2MB.';
                } else {
                    $photo_name = save_photo_admin($photo);
                    $stm = $_db->prepare('UPDATE user SET photo = ? WHERE user_id = ?');
                    $stm->execute([$photo_name, $user->user_id]);
                }
            }

            $_SESSION['user'] = (object) array_merge((array)$_SESSION['user'], [
                'email' => $email,
                'name' => $name,
                'birthday' => $birthday,
                'gender' => $gender,
                'role' => $role,
                'photo' => $photo_name ?? $user->photo,
            ]);

            temp('info', 'Profile updated successfully');
            redirect('admin.php');
        }
    }
}

$_title = 'Admin Profile';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/profile.js"></script>
    <title><?= htmlspecialchars($_title) ?></title>
    <style>
        .edit-icon {
            cursor: pointer;
            margin-left: 10px;
            color: blue;
        }

        .edit-form {
            display: none;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <h1><?= htmlspecialchars($_title) ?></h1>

    <div>
        <strong>Email:</strong> <?= htmlspecialchars($user->email) ?>
        <span class="edit-icon" onclick="showEditForm('email')">&#9998;</span>
        <div id="edit_email_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="email">
                <label for="email_value">New Email:</label><br>
                <input type="email" name="value" id="email_value" value="<?= htmlspecialchars($user->email) ?>">
                <button type="submit">Update</button>
                <button type="button" onclick="hideEditForm('email')">Cancel</button>
            </form>
        </div>
    </div>

    <div>
        <strong>Name:</strong> <?= htmlspecialchars($user->name) ?>
        <span class="edit-icon" onclick="showEditForm('name')">&#9998;</span>
        <div id="edit_name_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="name">
                <label for="name_value">New Name:</label><br>
                <input type="text" name="value" id="name_value" value="<?= htmlspecialchars($user->name) ?>">
                <button type="submit">Update</button>
                <button type="button" onclick="hideEditForm('name')">Cancel</button>
            </form>
        </div>
    </div>

    <div>
        <strong>Birthday:</strong> <?= htmlspecialchars($user->birthday) ?>
        <span class="edit-icon" onclick="showEditForm('birthday')">&#9998;</span>
        <div id="edit_birthday_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="birthday">
                <label for="birthday_value">New Birthday:</label><br>
                <input type="date" name="value" id="birthday_value" value="<?= htmlspecialchars($user->birthday) ?>">
                <button type="submit">Update</button>
                <button type="button" onclick="hideEditForm('birthday')">Cancel</button>
            </form>
        </div>
    </div>

    <div>
        <strong>Gender:</strong> <?= htmlspecialchars($user->gender) ?>
        <span class="edit-icon" onclick="showEditForm('gender')">&#9998;</span>
        <div id="edit_gender_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="gender">
                <label for="gender_value">New Gender:</label><br>
                <?= html_select('value', ['Male' => 'Male', 'Female' => 'Female'], $user->gender) ?>
                <button type="submit">Update</button>
                <button type="button" onclick="hideEditForm('gender')">Cancel</button>
            </form>
        </div>
    </div>

    <div>
        <strong>Role:</strong> <?= htmlspecialchars($user->role) ?>
        <span class="edit-icon" onclick="showEditForm('role')">&#9998;</span>
        <div id="edit_role_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="role">
                <label for="role_value">New Role:</label><br>
                <?= html_select('value', ['Admin' => 'Admin', 'User' => 'User'], $user->role) ?>
                <button type="submit">Update</button>
                <button type="button" onclick="hideEditForm('role')">Cancel</button>
            </form>
        </div>
    </div>

    <div>
        <strong>Photo:</strong> <img src="../uploads/<?= $user->photo ?>" alt="User Photo" style="width: 100px; height: auto;">
        <span class="edit-icon" onclick="showEditForm('photo')">&#9998;</span>
        <div id="edit_photo_form" class="edit-form">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="photo">
                <label for="photo_value">New Photo:</label><br>
                <input type="file" name="value" id="photo_value" accept="image/jpeg, image/png">
                <button type="submit">Update</button>
                <button type="button" onclick="hideEditForm('photo')">Cancel</button>
            </form>
        </div>
    </div>
<br>
    <div>
        <button onclick="toggleEditForm()">Edit All</button>
        <div id="editForm" class="edit-form">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="update_all" value="true">
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user->email) ?>"><br>

                <label for="name">Name:</label><br>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($user->name) ?>"><br>

                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" placeholder="New password"><br>

                <label for="birthday">Birthday:</label><br>
                <input type="date" name="birthday" id="birthday" value="<?= htmlspecialchars($user->birthday) ?>"><br>

                <label for="gender">Gender:</label><br>
                <?= html_select('gender', ['Male' => 'Male', 'Female' => 'Female'], $user->gender) ?><br>

                <label for="role">Role:</label><br>
                <?= html_select('role', ['Admin' => 'Admin', 'User' => 'User'], $user->role) ?><br>

                <label for="photo">Photo:</label><br>
                <input type="file" name="photo" id="photo" accept="image/jpeg, image/png"><br>

                <button type="submit">Update All</button>
                <button type="button" onclick="toggleEditForm('')">Cancel</button>
            </form>
        </div>
    </div>

    <br>
    <button><a href="admin.php">BACK TO MENU</a></button>

</body>

</html>