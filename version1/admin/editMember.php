<?php
include '../_base.php';
include '../_head.php';

auth('Admin');

// Check if ID is provided in the URL
if (!isset($_GET['user_id'])) {
    redirect('memberList.php');
}

$user_id = $_GET['user_id'];
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch the member's details
$stm = $_db->prepare('SELECT * FROM user WHERE user_id = ?');
$stm->execute([$user_id]);
$member = $stm->fetch(PDO::FETCH_OBJ);

if (!$member) {
    redirect('memberList.php');
}

// Handle form submission
if (is_post()) {
    $new_email = req('email');
    $new_name = req('name');
    $new_role = req('role');
    $new_gender = req('gender');
    $new_birthday = req('birthday');
    $new_photo = $_FILES['photo'];
    $new_status = req('status');

    // Update member's details
    $stm = $_db->prepare('UPDATE user SET email = ?, name = ?, role = ?, gender = ?, birthday = ?, status = ? WHERE user_id = ?');
    $stm->execute([$new_email, $new_name, $new_role, $new_gender, $new_birthday, $new_status, $user_id]);

    // Handle picture upload
    if ($new_photo['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($new_photo['type'], $allowed_types)) {
            $_err['photo'] = 'Invalid file type. Only JPEG and PNG are allowed.';
        } else if ($new_photo['size'] > 2 * 1024 * 1024) { // 2MB max size
            $_err['photo'] = 'File size exceeds 2MB.';
        } else {
            $photo_name = save_photo_admin($new_photo);
            $stm = $_db->prepare('UPDATE user SET photo = ? WHERE user_id = ?');
            $stm->execute([$photo_name, $user_id]);
            $_SESSION['user']->photo = $photo_name;
        }
    }

    temp('info', 'Member updated successfully');
    redirect('memberList.php');
}

$_title = 'Edit Member';
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
    <h1>Edit Member</h1>
    <form method="post" enctype="multipart/form-data" class="form">
        <div class="form-container">
            <div class="form-left">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($member->email) ?>" required maxlength="100">
                    <?= isset($_err['email']) ? "<span class='error'>{$_err['email']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($member->name) ?>" required maxlength="100">
                    <?= isset($_err['name']) ? "<span class='error'>{$_err['name']}</span>" : '' ?>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" id="role">
                        <option value="Member" <?= $member->role == 'Member' ? 'selected' : '' ?>>Member</option>
                        <option value="Admin" <?= $member->role == 'Admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender">
                        <option value="Male" <?= $member->gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $member->gender == 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status:</label>
                    <select name="status" id="status">
                        <option value="Active" <?= $member->status == 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Banned" <?= $member->status == 'Banned' ? 'selected' : '' ?>>Banned</option>
                    </select>
                </div>
            </div>

            <div class="form-right">
                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" name="birthday" id="birthday" value="<?= htmlspecialchars($member->birthday) ?>" required>
                </div>

                <label for="photo">Photo:</label>
                <div class="form-group upload">
                    <?php if ($member->photo): ?>
                        <label class="upload">
                            <?= html_file('photo', 'image/*', 'hidden') ?>
                            <img src="../uploads/<?= htmlspecialchars($member->photo) ?>" alt="Profile Photo">
                        </label>
                        <?= isset($_err['photo']) ? "<span class='error'>{$_err['photo']}</span>" : '' ?>
                    <?php else: ?>
                        <input type="file" name="photo" id="photo" accept="image/jpeg, image/png">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <button type="submit">Update Member</button>
    </form>
    <div class="action-buttons">
        <a href="memberList.php?page=<?= htmlspecialchars($page) ?>&search=<?= urlencode($search_query) ?>">
            <button>Back to Member List</button>
        </a>
    </div>

</body>

</html>