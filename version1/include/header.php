<?php
$user = $_SESSION['user']->name ?? 'guest';
$userID = $_SESSION['user']->user_id  ?? '0';

$countCartRecord = [];
$result = [];

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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/image.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/header.css">
</head>
<style>
    #info {
        position: fixed;
        color: #fff;
        background: #666;
        border: 1px solid #333;
        border-radius: 5px;
        padding: 10px 20px;
        left: 50%;
        translate: -50% 0;
        z-index: 999;

        top: -50px;
        opacity: 0;
    }

    #info:not(:empty) {
        animation: fade 5s;
    }

    @keyframes fade {
        0% {
            top: -100px;
            opacity: 0;
        }

        10% {
            top: 100px;
            opacity: 1;
        }

        90% {
            top: 100px;
            opacity: 1;
        }

        100% {
            top: -100px;
            opacity: 0;
        }
    }
</style>

<body>
    <header>
        <div class="first-row">
            <form class="search-bar" method="get" action="../customer/product.php" onsubmit="return searchProduct()">
                <button id="search-button" type="submit"><i class='bx bx-search' style="font-size:15px;"></i> search</button>
                <?= html_text("search")  ?>
            </form>
            <script>
                function searchProduct() {
                    var search = $("#search").val();

                    if (search === "") {
                        return false;
                    }

                    return true;
                }
            </script>

            <div class="brand">
                <h1> QIAN<span style="color:red">HO</span></h1>
            </div>

            

            <div class="small-icon">
            <div class="userAcc-block">
                <div class="user-icon">
                    <?php
                    $img = ($_SESSION['user']->photo != null) ? "../uploads/" . $_SESSION['user']->photo : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png";
                    ?>
                    <img style="  object-fit: cover;" src="<?= $img ?>" width="40" height="40">
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
                        <?php if ($userID != '0') { ?>
                            <span style="font-size:10px;">
                                <?= $result['total_records']  ?>
                            </span>
                        <?php } ?>
                    </P>
                </a>

                <span style="font-size:30px;cursor:pointer" class="openbtn">&#9776;</span>
                <script src="../js/header.js"></script>
            </div>
        </div>
        <!-- <div class="second-row">

         

        </div> -->
    </header>



    