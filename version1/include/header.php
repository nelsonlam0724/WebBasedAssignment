<?php
$user = $_SESSION['user']->name ?? 'guest';
$userID = $_SESSION['user']->user_id  ?? '0';

$countCartRecord=[];
$result=[] ;

if ($userID != '0') {
    $countCartRecord = $_db->prepare('SELECT COUNT(*) AS total_records FROM carts WHERE user_id = ? ');
    $countCartRecord->execute([$userID]);
    $result = $countCartRecord->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>


    <header>

        <div class="first-row">

            <div class="search-bar">
                <button id="search-button"><i class='bx bx-search' style="font-size:15px;"></i> search</button>
                <input id="search" type="text">
            </div>

            <div class="brand">
                <h1> QIAN<span style="color:red">HO</span></h1>
            </div>

            <div class="userAcc-block">
                <div class="user-icon">
                    <img style="  object-fit: cover;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" width="40" height="40">
                </div>
                <div class="text">
                    <div class="text-first">
                        <h6 data-user="<?= $userID ?>">Hi,<?= $user ?></h6>
                    </div>
                </div>
            </div>

            <a href="../customer/cart.php">
                <p style="font-size: 30px;cursor:pointer;color:black;" class="cart-icon">
                    <i class='bx bx-cart'></i>
               <?php if ($userID != '0') {?>
                    <span style="font-size:10px;">
                    <?=  $result['total_records']  ?>
                </span>
                <?php } ?>
            </P>
            </a>

        </div>
        <div class="second-row">

            <ul>
                <li>SHOP</li>
                <li>NEW</li>
                <li>BRANDS</li>
                <li>GIFTS</li>
                <li>SALE</li>
                <li>COMUNITY</li>
                <li>MAPPENING IN STORE</li>
            </ul>

        </div>
    </header>