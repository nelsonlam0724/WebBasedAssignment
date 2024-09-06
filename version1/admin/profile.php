<?php
include '../_base.php';
include '../_head.php';

if (is_get()) {
    $stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
    $stm->execute([$_user->user_id]);
    $u = $stm->fetch();

    if ($u->role != "Admin") {
        redirect('../login.php');
    }
}
$user = $_SESSION['user'];

// Initialize error array
$_err = [];

// Handle form submission (POST request)
if (is_post()) {

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


$_title = 'Admin Profile';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/profile.js"></script>
    <title><?= htmlspecialchars($_title) ?></title>
    <link rel="stylesheet" href="../css/adminProfile.css">
</head>

<body>
    <div class="container">
        <h1><?= htmlspecialchars($_title) ?></h1>

        <table>
            <tr>
                <td><strong>Email:</strong></td>
                <td><?= htmlspecialchars($user->email) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('email', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?= htmlspecialchars($user->name) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('name', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Password:</strong></td>
                <td>*****</td>
                <td><span class="edit-icon" onclick="toggleEditForm('password', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Birthday:</strong></td>
                <td><?= htmlspecialchars($user->birthday) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('birthday', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Gender:</strong></td>
                <td><?= htmlspecialchars($user->gender) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('gender', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Photo:</strong></td>
                <td><img src="../uploads/<?= htmlspecialchars($user->photo) ?>" alt="User Photo"></td>
                <td><span class="edit-icon" onclick="toggleEditForm('photo', event)">&#9998;</span></td>
            </tr>
        </table>

        <div id="edit_email_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="email">
                <label for="email_value">New Email:</label>
                <input type="text" name="value" id="email_value" value="<?= htmlspecialchars($user->email) ?>">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('email')">Cancel</button>
            </form>
        </div>

        <div id="edit_name_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="name">
                <label for="name_value">New Name:</label>
                <input type="text" name="value" id="name_value" value="<?= htmlspecialchars($user->name) ?>">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('name')">Cancel</button>
            </form>
        </div>

        <div id="edit_password_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="password">
                <label for="password_value">New Password:</label>
                <input type="password" name="value" id="password_value">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('password')">Cancel</button>
            </form>
        </div>

        <div id="edit_birthday_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="birthday">
                <label for="birthday_value">New Birthday:</label>
                <input type="date" name="value" id="birthday_value" value="<?= htmlspecialchars($user->birthday) ?>">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('birthday')">Cancel</button>
            </form>
        </div>

        <div id="edit_gender_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="gender">
                <label for="gender_value">New Gender:</label>
                <?= html_select('value', ['Male' => 'Male', 'Female' => 'Female'], $user->gender) ?>
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('gender')">Cancel</button>
            </form>
        </div>

        <div id="edit_photo_form" class="edit-form">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="photo">
                <label for="photo_value">New Photo:</label>
                <input type="file" name="value" id="photo_value" accept="image/jpeg, image/png">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('photo')">Cancel</button>
            </form>
        </div>

        <div class="action-buttons">
            <a href="editProfile.php"><button>Edit All</button></a>
            <a href="admin.php"><button>Back to Menu</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </div>
    </div>
</body>

</html>