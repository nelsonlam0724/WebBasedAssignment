<?php
include '../_base.php';
include '../_head.php';

auth('Root','Admin');
// Fetch user profile information
$user = $_SESSION['user'];

$_title = 'Admin Dashboard - ' . htmlspecialchars($user->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>

<body>
    <h1>Welcome, <?= htmlspecialchars($user->name) ?> to the Admin Dashboard</h1>
    <nav>
        <ul style="list-style-type: none;">
            <li><a href="profile.php"><button>Admin Profile</button></a></li>
            <li><a href="userList.php"><button>User List</button></a></li>
            <li><a href="orderList.php"><button>Order List</button></a></li>
            <li><a href="backup.php"><button>Backup</button></a></li>
            <li><a href="restore.php"><button>Restore</button></a></li>
            <li><a href="../customer/customer.php"><button>Customer Page</button></a></li>
            <li><a href="../logout.php"><button>Logout</button></a></li>
        </ul>
    </nav>
    <p>Here you can manage your admin tasks.</p>
</body>

</html>