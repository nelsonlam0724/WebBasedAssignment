<?php
include '../_base.php';
include '../_head.php';
include '../include/sidebarAdmin.php'; 
auth('Root','Admin');

// Initialize error array
$_err = [];
// Handle form submission (POST request)
if (is_post()) {

    $field = req('field');
    $value = req('value');
    $currentEmail = req('email');
    $email = req('email');
    
    switch ($field) {
        case 'email':
            if (strlen($value) > 100) {
                $_err['email'] = 'Maximum 100 characters';
                temp('info', 'Maximum 100 characters.');
            } else if (!is_email($value)) {
                $_err['email'] = 'Invalid email.';
                temp('info', 'Invalid Email');
            } else if ($value !== $currentEmail) {
                // Check for duplicate only if the email is different from the current email
                $stmt = $_db->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
                $stmt->execute(['email' => $value]);
                $emailCount = $stmt->fetchColumn();
                if ($emailCount > 0) {
                    $_err['email'] = 'Email is already in use';
                    temp('info', 'Email is already in use.');
                } else {
                    // Proceed to update the email
                    $stm = $_db->prepare('UPDATE user SET email = ? WHERE user_id = ?');
                    $stm->execute([$value, $_user->user_id]);
                    $_user->email = $value;
                }
            }
            break;

        case 'name':
            if (strlen($value) > 100) {
                $_err['name'] = 'Maximum 100 characters';
                temp('info','Maximum 100 characters.');
            } else {
                $stm = $_db->prepare('UPDATE user SET name = ? WHERE user_id = ?');
                $stm->execute([$value, $_user->user_id]);
                $_user->name = $value;
            }
            break;

        case 'password':
            if (strlen($value) < 5 || strlen($value) > 100) {
                $_err['password'] = 'Between 5-100 characters';
                temp('info','Between 5-100 characters.');
            } else {
                $hashed_password = password_hash($value, PASSWORD_DEFAULT);
                $stm = $_db->prepare('UPDATE user SET password = ? WHERE user_id = ?');
                $stm->execute([$hashed_password, $_user->user_id]);
            }
            break;

            case 'birthday':
                if (!$value) {
                    $_err['birthday'] = 'Required';
                } else if (!is_birthday($value)) {
                    $_err['birthday'] = 'Invalid date format';
                } else {
                    $birthdate_parts = explode('-', $value);
                    if (!checkdate($birthdate_parts[1], $birthdate_parts[2], $birthdate_parts[0])) {
                        $_err['birthday'] = 'Invalid date';
                    } else {
                        $input_date = new DateTime($value);
                        $today = new DateTime();  // Today's date
            
                        // Set the time of both dates to the start of the day to ensure accurate comparison
                        $input_date->setTime(0, 0, 0);
                        $today->setTime(0, 0, 0);
            
                        if ($input_date > $today) {
                            $_err['birthday'] = 'Date must be before today';
                        } else {
                            // Update the database if no errors
                            $stm = $_db->prepare('UPDATE user SET birthday = ? WHERE user_id = ?');
                            $stm->execute([$value, $_user->user_id]);
                            $_user->birthday = $value;
                        }
                    }
                }
                break;            

        case 'gender':
            if (!is_gender($value)) {
                $_err['gender'] = 'Invalid gender';
                temp('info','Invalid gender.');
            } else {
                $stm = $_db->prepare('UPDATE user SET gender = ? WHERE user_id = ?');
                $stm->execute([$value, $_user->user_id]);
                $_user->gender = $value;
            }
            break;

        case 'photo':
            $photo = $_FILES['value'];
            $allowed_types = ['image/jpeg', 'image/png'];
            if (!in_array($photo['type'], $allowed_types)) {
                $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
                temp('info','Invalid file type. Only JPEG and PNG are allowed.');
            } else if ($photo['size'] > 2 * 1024 * 1024) { // 2MB max size
                $_err['photo'] = 'File size exceeds 2MB.';
                temp('info','File size exceeds 2MB.');
            } else {
                $photo_name = save_photo_admin($photo);
                $stm = $_db->prepare('UPDATE user SET photo = ? WHERE user_id = ?');
                $stm->execute([$photo_name, $_user->user_id]);
                $_user->photo = $photo_name;
            }
            break;
    }

    if (empty($_err)) {
        temp('info', 'Profile updated successfully');
        redirect('profile.php');
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
                <td><?= htmlspecialchars($_user->email) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('email', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td><?= htmlspecialchars($_user->name) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('name', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Password:</strong></td>
                <td>*****</td>
                <td><span class="edit-icon" onclick="toggleEditForm('password', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Birthday:</strong></td>
                <td><?= htmlspecialchars($_user->birthday) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('birthday', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Gender:</strong></td>
                <td><?= htmlspecialchars($_user->gender) ?></td>
                <td><span class="edit-icon" onclick="toggleEditForm('gender', event)">&#9998;</span></td>
            </tr>
            <tr>
                <td><strong>Photo:</strong></td>
                <td><img src="../uploads/<?= htmlspecialchars($_user->photo) ?>" alt="User Photo"></td>
                <td><span class="edit-icon" onclick="toggleEditForm('photo', event)">&#9998;</span></td>
            </tr>
        </table>

        <div id="edit_email_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="email">
                <label for="email_value">New Email:</label>
                <input type="text" name="value" id="email_value" value="<?= htmlspecialchars($_user->email) ?>">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('email')">Cancel</button>
            </form>
        </div>

        <div id="edit_name_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="name">
                <label for="name_value">New Name:</label>
                <input type="text" name="value" id="name_value" value="<?= htmlspecialchars($_user->name) ?>">
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
                <input type="date" name="value" id="birthday_value" value="<?= htmlspecialchars($_user->birthday) ?>">
                <button type="submit">Update</button>
                <button type="button" class="cancel" onclick="hideEditForm('birthday')">Cancel</button>
            </form>
        </div>

        <div id="edit_gender_form" class="edit-form">
            <form method="post">
                <input type="hidden" name="update_part" value="true">
                <input type="hidden" name="field" value="gender">
                <label for="gender_value">New Gender:</label>
                <?= html_select('value', ['Male' => 'Male', 'Female' => 'Female'], $_user->gender) ?>
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