<?php
include '../_base.php';
include '../include/header.php';
include '../include/sidebar.php';

auth('Member');
// Fetch user profile information
$user = $_SESSION['user'];


$getPending = $_db->prepare('
    SELECT * FROM `orders` 
    WHERE user_id = ? AND status = ?
    ORDER BY id DESC
');


$getPending->execute([$userID, "Pending"]);
$results = $getPending->fetchAll();

?>

<link rel="stylesheet" href="../css/information.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/orders.js"></script>
</head>

<body>


    <div class="tabs">
        <label class="label" onclick="back()"><i class="fa fa-angle-double-left" style="color:white"></i>Back</label>
        <input class="input" name="tabs" type="radio" id="tab-1" checked="checked" />
        <label class="label" for="tab-1">To Pay</label>
        <div class="panel">

            <?php
            $current_time = time();

            $stm = $_db->prepare("
            SELECT o.id, od.product_id, od.unit 
            FROM orders AS o 
            JOIN order_details AS od ON o.id = od.order_id
            WHERE o.status = ? AND o.created_at < NOW() - INTERVAL 1 MINUTE
        ");
        $stm->execute(['Pending']);
        $orders = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($orders as $order) {
            $stm = $_db->prepare("UPDATE orders SET status = 'Cancelled' WHERE id = :id");
            $stm->bindParam(':id', $order['id'], PDO::PARAM_STR);
            $stm->execute();
        
            $stmt = $_db->prepare('SELECT quantity FROM product WHERE product_id = ?');
            $stmt->execute([$order['product_id']]);
            $productStock = $stmt->fetch(PDO::FETCH_ASSOC);
        
            $stmt = $_db->prepare('UPDATE product SET quantity = ? WHERE product_id = ?');
            $stmt->execute([$productStock['quantity'] + $order['unit'], $order['product_id']]);
        }
        
            $count = 0;
            foreach ($results as $o): ?>
                <div class="item-container">
                    <div class="item-details">
                        <div class="item-text">
                            <h2><?= $count + 1 ?>.Order ID : <?= $o->id ?></h2>
                            <p class="pp">Total amount : RM <?= $o->total ?></p>
                            <p class="pp">Date order : <?= $o->datetime ?></p>
                            <a href="details.php?ship_id=<?= $o->ship_id ?>&order_id=<?= $o->id ?>&check=0"><button class="check-button">Check</button></a>
                        </div>
                    </div>

                </div>
            <?php $count++;
            endforeach ?>
         
         <?php
                  if($results==NULL){
                    echo '<p style="font-size:25px;">No Orders Yet</p>';
                  }

  ?>

        </div>

        <input class="input" name="tabs" type="radio" id="tab-3" />
        <label class="label" for="tab-3">Shipping details</label>
        <div class="panel">
            <?php

            $getShip = $_db->prepare('
                SELECT s.* , o.* , s.status AS ship_status
                FROM `shippers` AS s 
                JOIN `orders` AS o ON s.ship_id = o.ship_id
                WHERE o.user_id = ? AND o.status = ?
            ');

            $getShip->execute([$userID, "Paid"]);
            $shipResults = $getShip->fetchAll();

            ?>



            <?php $counts = 0;
            foreach ($shipResults as $o): ?>
                <div class="product-container" style="padding:28px">
                    <div class="product-details">
                        <div class="product-title"><?= $counts + 1 ?>.Shipping ID : <?= $o->ship_id ?></div>
                        <div class="product-description">Address : <?= $o->address ?></div>
                        <!-- <div class="product-description">Recipient name : <?= $o->name ?></div> -->
                        <div class="product-description">Status : <?= $o->ship_status ?> </div>
                        <div class="product-description">Company : <?= $o->company_name ?> </div>
                        <div class="product-description" style="color:rgb(77, 130, 24)">Ship Method : <?= $o->ship_method ?> </div>
                        <a href="details.php?ship_id=<?= $o->ship_id ?>&order_id=<?= $o->id ?>&check=1"><button class="rate-button" onclick="view_detail('<%= ship[0] %>', '<%= ship[5] %>')">View detail</button></a>
                    </div>

                </div>
            <?php $counts++;
            endforeach  ?>

<?php
                  if($shipResults==NULL){
                    echo '<p style="font-size:25px;">No Orders Yet</p>';
                  }

  ?>
        </div>

        <input class="input" name="tabs" type="radio" id="tab-4" />
        <label class="label" for="tab-4">To Rate</label>
        <div class="panel">

            <?php

            $getPaid = $_db->prepare('
               SELECT od.* ,o.* , p.product_id , p.name AS product_name ,od.price AS odPrice
               FROM order_details AS od 
               JOIN orders AS o ON od.order_id = o.id
               JOIN product AS p ON od.product_id = p.product_id
               JOIN shippers AS s ON o.ship_id = s.ship_id
               WHERE o.status = ? AND o.user_id = ? AND od.commment_status = ? AND s.status = ?
               ');

            $getPaid->execute(["Paid", $userID, "Pending", "Arrive"]);
            $results = $getPaid->fetchAll();

            ?>

            <?php $count = 0;
            foreach ($results as $o): ?>
                <div class="item-container">
                   <?php   
                    $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
                    $getProductImg->execute([$o->product_id]);
                    $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
                    $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';
                   ?>
                    <div class="item-details">
                        <img src="../uploads/<?= $productPhoto ?>" alt="" class="item-image" width="100" height="100">
                        <div class="item-text">
                            <h2>Product ID :<?= $o->product_id ?></h2>
                            <h3><?= $o->product_name  ?></h3>
                            <h3>unit : <?= $o->unit ?></h3>
                            <h3>price : <?= $o->odPrice ?></h3>
                            <p class="pp" style="color:orangered">Subtotal :RM <?= $o->subtotal ?></p>
                        </div>

                    </div>

                    <a href="comment.php?id=<?= $o->product_id ?>&order_id=<?= $o->order_id ?>"><button class="rate-button" style="width:150px">Rate</button></a>
                </div>
            <?php endforeach; ?>
            <?php
                  if($results==NULL){
                    echo '<p style="font-size:25px;">No product to rate</p>';
                  }

  ?>
        </div>

        


</body>
<script>

  function back() {
    window.history.back();
  }
</script>

</html>