<?php
include '../_base.php';
include '../_head.php';

auth('Member');
$stm = $_db->prepare('SELECT * FROM address WHERE user_id = ?');
$stm->execute([$_user->user_id]);
$address = $stm->fetch(PDO::FETCH_OBJ);
// Initialize error array
$_err = [];

if (is_post()) {
    // Capture and validate input
    $email = req('email');
    $name = req('name');
    $contact_num = req('contact_num');
    $password = req('password');
    $confirm = req('confirm');
    $birthday = req('birthday');
    $gender = req('gender');
    $photo = $_FILES['photo'];
    $street = req('street');
    $city = req('city');
    $state = req('state');
    $postal_code = req('postal_code');
    $country = req('country');

    // Validation: email
    if (!$email) {
        $_err['email'] = 'Required';
    } else if (strlen($email) > 100) {
        $_err['email'] = 'Maximum 100 characters';
    } else if (!is_email($email)) {
        $_err['email'] = 'Invalid email';
    } else if ($email !== $_user->email) { // Check for uniqueness only if email has changed
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $emailCount = $stmt->fetchColumn();

        if ($emailCount > 0) {
            $_err['email'] = 'Email is already in use';
        }
    }

    if (!empty($password)) {
        // Validate new password
        if (strlen($password) < 5 || strlen($password) > 100) {
            $_err['password'] = 'Between 5-100 characters';
        } else if ($confirm !== $password) {
            $_err['confirm'] = 'Passwords do not match';
        }
    }

    // Validation: name
    if (!$name) {
        $_err['name'] = 'Required';
    } else if (strlen($name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
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

            // Set the time of both dates to the start of the day to ensure accurate comparison
            $input_date->setTime(0, 0, 0);
            $today->setTime(0, 0, 0);

            if ($input_date > $today) {
                $_err['birthday'] = 'Date must be before today';
            }
        }
    }
    // Validation: gender
    if (!$gender) {
        $_err['gender'] = 'Required';
    } else if (!is_gender($gender)) {
        $_err['gender'] = 'Invalid gender';
    }

    // Validate: contact_num
    if (!$contact_num) {
        $_err['contact_num'] = 'Required';
    } else if (!preg_match('/^[0]{1}[1]{1}[0-9]{1}-[0-9]{7,8}$/', $contact_num)) {
        $_err['contact_num'] = 'Invalid contact number format. Should be like 01X-XXXXXXX.';
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
        $photo_name = $_user->photo;
    }

    // Validate street
    if (empty($street)) {
        $_err['street'] = 'Street address is required.';
    } elseif (strlen($street) < 5) {
        $_err['street'] = 'Street address must be at least 5 characters long.';
    }

    // Validate city
    if (empty($city)) {
        $_err['city'] = 'City is required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $city)) {
        $_err['city'] = 'City can only contain letters and spaces.';
    }

    // Validate state
    if (empty($state)) {
        $_err['state'] = 'State is required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $state)) {
        $_err['state'] = 'State can only contain letters and spaces.';
    }

    // Validate postal code
    if (empty($postal_code)) {
        $_err['postal_code'] = 'Postal code is required.';
    } elseif (!preg_match("/^\d{5}(-\d{4})?$/", $postal_code)) {
        $_err['postal_code'] = 'Postal code must be in the format 12345 or 12345-6789.';
    }

    // Validate country
    if (empty($country)) {
        $_err['country'] = 'Country is required.';
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $country)) {
        $_err['country'] = 'Country can only contain letters and spaces.';
    }

    if (empty($_err)) {
        // If a new photo was uploaded, save it and update $photo_name
        if (!empty($photo['name']) && $photo['error'] === UPLOAD_ERR_OK) {
            $photo_name = save_photo_admin($photo);
        }

        // Update user information
        $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, contact_num = ?, password = SHA(?) , birthday = ?, gender = ?, photo = ? WHERE user_id = ?');
        $stm->execute([$email, $name, $contact_num, $password, $birthday, $gender, $photo_name, $_user->user_id]);
        // Update address details
        $stm = $_db->prepare('UPDATE address SET street = ?, city = ?, state = ?, postal_code = ?, country = ? WHERE user_id = ?');
        $stm->execute([$street, $city, $state, $postal_code, $country, $_user->user_id]);
        // Update session data
        $_SESSION['user'] = (object) array_merge((array)$_SESSION['user'], [
            'email' => $email,
            'name' => $name,
            'contact_num' => $contact_num,
            'birthday' => $birthday,
            'gender' => $gender,
            'photo' => $photo_name,
        ]);
        temp('info', 'Profile updated successfully');
        redirect('customerEditProfile.php');
    }
}

$_title = 'Edit Profile';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profileCustomerEdit.css">
    <script src="../js/profile.js"></script>
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>
    <?php include '../include/header.php';
    include '../include/sidebar.php';  ?>
    <br><br><br><br><br>
    <h1><?= htmlspecialchars($_title) ?></h1>

    <div class="form">
        <form method="post" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-left">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" maxlength="100" value="<?= htmlspecialchars($_user->email) ?>" required>
                        <?= isset($_err['email']) ? "<span class='error'>{$_err['email']}</span>" : '' ?>
                    </div>

                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" maxlength="100" value="<?= htmlspecialchars($_user->name) ?>" required>
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
                        <label for="contact_num">Phone Number:</label>
                        <input type="contact_num" name="contact_num" id="contact_num" value="<?= htmlspecialchars($_user->contact_num) ?>" maxlength="12">
                        <?= isset($_err['contact_num']) ? "<span class='error'>{$_err['contact_num']}</span>" : '' ?>
                    </div>

                </div>

                <div class="form-middle">
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="gender" required>
                            <option value="Male" <?= $_user->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $_user->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                        </select>
                        <?= isset($_err['gender']) ? "<span class='error'>{$_err['gender']}</span>" : '' ?>
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday:</label>
                        <input type="date" name="birthday" id="birthday" value="<?= htmlspecialchars($_user->birthday) ?>" required>
                        <?= isset($_err['birthday']) ? "<span class='error'>{$_err['birthday']}</span>" : '' ?>
                    </div>

                    <label for="photo">Photo:</label>
                    <div class="form-group upload">
                        <label class="upload">
                            <?= html_file('photo', 'image/*', 'hidden') ?>
                            <img src="../uploads/<?= htmlspecialchars($_user->photo) ?>" alt="Profile Photo">
                        </label>
                        <?= isset($_err['photo']) ? "<span class='error'>{$_err['photo']}</span>" : '' ?>
                    </div>
                </div>

                <div class="form-right">
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" name="street" id="street" value="<?= htmlspecialchars($address->street ?? '') ?>" maxlength="255">
                        <?= isset($_err['street']) ? "<span class='error'>{$_err['street']}</span>" : '' ?>
                    </div>

                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" name="city" id="city" value="<?= htmlspecialchars($address->city ?? '') ?>" maxlength="100">
                        <?= isset($_err['city']) ? "<span class='error'>{$_err['city']}</span>" : '' ?>
                    </div>

                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" name="state" id="state" value="<?= htmlspecialchars($address->state ?? '') ?>" maxlength="100">
                        <?= isset($_err['state']) ? "<span class='error'>{$_err['state']}</span>" : '' ?>
                    </div>

                    <div class="form-group">
                        <label for="postal_code">Postal Code:</label>
                        <input type="text" name="postal_code" id="postal_code" value="<?= htmlspecialchars($address->postal_code ?? '') ?>" maxlength="20">
                        <?= isset($_err['postal_code']) ? "<span class='error'>{$_err['postal_code']}</span>" : '' ?>
                    </div>

                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" name="country" id="country" value="<?= htmlspecialchars($address->country ?? '') ?>" maxlength="100">
                        <?= isset($_err['country']) ? "<span class='error'>{$_err['country']}</span>" : '' ?>
                    </div>
                </div>
            </div>
            <div class="submit_button"><button type="submit">Save Changes</button></div>

        </form>
    </div>
    <div class="action-buttons">
        <a href="customerProfile.php"><button type="button">Back to Profile</button></a>
    </div>
</body>

</html>