<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminHome.css">
    <script src="../js/adminHome.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <button id="toggle-btn" class="toggle-btn">
        <div class="burger-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>

    <div class="sidebar" id="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i><span class="menu-text">Dashboard</span></a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i><span class="menu-text">Admin Profile</span></a></li>
            <li><a href="userList.php"><i class="fas fa-users"></i><span class="menu-text">User List</span></a></li>
            <li><a href="orderList.php"><i class="fas fa-list"></i><span class="menu-text">Order List</span></a></li>
            <li><a href="productList.php"><i class="fas fa-box"></i><span class="menu-text">Product List</span></a></li>
            <li><a href="categoryList.php"><i class="fas fa-tags"></i><span class="menu-text">Category List</span></a></li>
            <li><a href="backup.php"><i class="fas fa-database"></i><span class="menu-text">Backup</span></a></li>
            <li><a href="restore.php"><i class="fas fa-upload"></i><span class="menu-text">Restore</span></a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i><span class="menu-text">Logout</span></a></li>
        </ul>
    </div>
</body>
</html>
