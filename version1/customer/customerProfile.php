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
            redirect('customer.php');
        }
    }



$_title = 'Member Profile';
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
        <a href="customerEditProfile.php"><button>Edit All</button></a>
    </div>


    <a href="customer.php"><button>Back to Menu</button></a><br>
    <a href="../logout.php"><button>Logout</button></a>
</body>

</html>