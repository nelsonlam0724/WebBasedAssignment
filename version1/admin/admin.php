<?php
include '../_base.php';
include '../_head.php';

auth('Root', 'Admin');
// Fetch user profile information

$_title = 'Admin Dashboard - ' . htmlspecialchars($_user->name);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    h1 {
        text-align: center;
        color: #333;
        margin-top: 20px;
    }

    nav {
        text-align: center;
        margin: 20px 0;
    }

    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    li {
        margin: 10px 0;
    }

    button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    p {
        text-align: center;
        color: #666;
        font-size: 18px;
    }
</style>

<body>
    <h1>Welcome, <?= htmlspecialchars($_user->name) ?> to the Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="profile.php"><button>Admin Profile</button></a></li>
            <li><a href="userList.php"><button>User List</button></a></li>
            <li><a href="orderList.php"><button>Order List</button></a></li>
            <li><a href="backup.php"><button>Backup</button></a></li>
            <li><a href="restore.php"><button>Restore</button></a></li>
            <li><a href="produtList.php"><button>Product List</button></a></li>
            <li><a href="../customer/customer.php"><button>Customer Page</button></a></li>
            <li><a href="../logout.php"><button>Logout</button></a></li>
        </ul>
    </nav>
    <p>Here you can manage your admin tasks.</p>
</body>

</html>