<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn">&times;</a>
    <div class="content">
        <div class="profile">
            <img style="object-fit: cover;" src="<?= $img ?>" width="80">
            <h2 style="color:white"><?= $user ?></h2>
            <p><?= $_SESSION['user']->email ?></p>
        </div>
        <div style="padding:50px 9px;">

            <a class="als" href="customer.php"><i class="fa fa-home"></i> Home</a>
            <a class="als" href="wishList.php"> <i class="fas fa-heart"></i> Wish List</a>
            <a class="als" href="product.php"><i class='fas fa-address-book'></i> Product</a>
            <a class="als" href="information.php"> <i class="fas fa-shopping-bag"></i> My Purchase</a>
            <a class="als" href="orders.php"><i class="fas fa-box"></i> My Order</a>
           

        </div>
    </div>
</div>