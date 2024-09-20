<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adminHome.css">
    <script src="../js/adminHome.js" defer></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
            <li><a href="profile.php">Admin Profile</a></li>
            <li><a href="userList.php">User List</a></li>
            <li><a href="orderList.php">Order List</a></li>
            <li><a href="backup.php">Backup</a></li>
            <li><a href="restore.php">Restore</a></li>
            <li><a href="productList.php">Product List</a></li>
            <li><a href="../customer/customer.php">Customer Page</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
