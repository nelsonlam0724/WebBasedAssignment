<?php
include '_base.php';


$email = $_SESSION['email']; // Retrieve email from session
if (empty($_SESSION['email']) || !$_SESSION['email']) {
    temp('info', 'You need to verify your email.');
    redirect('login.php');
    exit;
}

if (is_post()) {
    $name = req('name');
    $password = req('password');
    $confirm = req('confirm');
    $f = get_file('photo');
    $gender = req('gender');
    $birthday = req('birthday');
    $contact_num = req('contact_num');
    // Address
    $street = req('street');
    $city = req('city');
    $state = req('state');
    $postal_code = req('postal_code');
    $country = req('country');
    // Validate form data...
    $_err = [];

    // Validate email (from session)
    if (!$email) {
        $_err['email'] = 'Required';
    } else if (strlen($email) > 100) {
        $_err['email'] = 'Maximum 100 characters';
    } else if (!is_email($email)) {
        $_err['email'] = 'Invalid email';
    } else if (!is_unique($email, 'user', 'email')) {
        $_err['email'] = 'Duplicated';
    }

    // Validate password
    if (!$password) {
        $_err['password'] = 'Required';
    } else if (strlen($password) < 5 || strlen($password) > 100) {
        $_err['password'] = 'Between 5-100 characters';
    }

    // Validate confirm password
    if (!$confirm) {
        $_err['confirm'] = 'Required';
    } else if (strlen($confirm) < 5 || strlen($confirm) > 100) {
        $_err['confirm'] = 'Between 5-100 characters';
    } else if ($confirm != $password) {
        $_err['confirm'] = 'Not matched';
    }

    // Validate name
    if (!$name) {
        $_err['name'] = 'Required';
    } else if (strlen($name) > 100) {
        $_err['name'] = 'Maximum 100 characters';
    }

    // Validate gender
    if (!$gender) {
        $_err['gender'] = 'Required';
    } else if (!in_array($gender, ['Male', 'Female', 'Other'])) {
        $_err['gender'] = 'Invalid gender';
    }

    // Validate: contact_num
    if (!$contact_num) {
        $_err['contact_num'] = 'Required';
    } else if (!preg_match('/^[0]{1}[1]{1}[0-9]{1}-[0-9]{7,8}$/', $contact_num)) {
        $_err['contact_num'] = 'Invalid contact number format. Should be like 01X-XXXXXXX.';
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

    // Validate photo
    if (!$f) {
        $_err['photo'] = 'Required';
    } else if (!str_starts_with($f->type, 'image/')) {
        $_err['photo'] = 'Must be an image';
    } else if ($f->size > 1 * 1024 * 1024) {
        $_err['photo'] = 'Maximum 1MB';
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

    if (!$_err) {
        // Process registration
        $photo = save_photo($f);
        $user_id = generateID('user', 'user_id', 'U', 4);
        $stm = $_db->prepare('
            INSERT INTO user (user_id, email, password, contact_num, name, gender, birthday, photo, role, status)
            VALUES (?, ?, SHA(?), ?, ?, ?, ?, ?, "Member", "Active")
        ');
        $stm->execute([$user_id, $email, $password, $contact_num, $name, $gender, $birthday, $photo]);

        // Generate address ID
        $address_id = generateID('address', 'address_id', 'A', 4);

        // Insert into address table if any address field is provided
        $stm = $_db->prepare('INSERT INTO address (address_id, street, city, state, postal_code, country, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stm->execute([$address_id, $street, $city, $state, $postal_code, $country, $user_id]);

        // Unset verification only after successful registration
        unset($_SESSION['verified']);
        unset($_SESSION['email']);  // Optionally clear email

        temp('info', 'Record inserted');
        redirect('login.php');
    }
}

unset($_SESSION['verified']);

$_title = 'Register Member';
include '_head.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/image.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/simpleDesign.css">
    <script src="js/profile.js"></script>
    <title><?= htmlspecialchars($_title) ?></title>
</head>

<body>
    <h1>Register New Member</h1>
    <form method="post" class="form" enctype="multipart/form-data">
        <div class="form-container">
            <div class="form-left">
                <label for="email">Email:</label>
                <p style="color: blue;"><?= htmlspecialchars($email) ?></p>

                <label for="name">Name:</label>
                <?= html_text('name', 'maxlength="100"') ?>
                <?= err('name') ?>

                <label for="password">Password:</label>
                <?= html_password('password', 'maxlength="100"') ?>
                <?= err('password') ?>

                <label for="confirm">Confirm Password:</label>
                <?= html_password('confirm', 'maxlength="100"') ?>
                <?= err('confirm') ?>

                <label for="contact_num">Phone Number:</label>
                <?= html_text('contact_num', 'maxlength="12" placeholder="Enter your phone number"') ?>
                <?= err('contact_num') ?>
            </div>

            <!-- Middle Column -->
            <div class="form-middle">

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

                <label for="birthday">Birthday:</label>
                <?= html_date('birthday', 'required') ?>
                <?= err('birthday') ?>


                <label class="upload">
                    <?= html_file('photo', 'image/*', 'hidden') ?>
                    <img src="images/photo.jpg" alt="Profile Photo">
                </label>
                <?= err('photo') ?>
            </div>

            <!-- Right Column -->
            <div class="form-right">
                <label for="street">Street:</label>
                <?= html_text('street', 'maxlength="255"') ?>
                <?= err('street') ?>

                <label for="city">City:</label>
                <?= html_text('city', 'maxlength="100"') ?>
                <?= err('city') ?>

                <label for="state">State:</label>
                <?= html_text('state', 'maxlength="100"') ?>
                <?= err('state') ?>

                <label for="postal_code">Postal Code:</label>
                <?= html_text('postal_code', 'maxlength="20"') ?>
                <?= err('postal_code') ?>

                <label for="country">Country:</label>
                <?= html_text('country', 'maxlength="100"') ?>
                <?= err('country') ?>
            </div>
        </div>
        <section class="form-actions">
            <button type="submit">Register</button>
            <button type="reset">Reset</button>
        </section>
    </form>
    <div class="action-buttons">
        <a href="logout.php"><button>Back to Login</button></a>
    </div>
</body>

</html>