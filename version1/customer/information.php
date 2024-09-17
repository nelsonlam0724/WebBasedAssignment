<?php
include '../_base.php';
include '../include/header.php';

auth('Role', 'Admin', 'Member');
// Fetch user profile information
$user = $_SESSION['user'];

$getPending = $_db->prepare('
    SELECT * FROM `orders` WHERE user_id = ? AND status = ?
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

            <?php $count = 0;
            foreach ($results as $o): ?>
                <div class="item-container">
                    <div class="item-details">
                        <div class="item-text">
                            <h2><?= $count + 1 ?>.Order ID : <?= $o->id ?></h2>
                            <p>Total amount : RM <?= $o->total ?></p>
                            <p>Date order : <?= $o->datetime ?></p>
                            <a href="details.php?ship_id=<?= $o->ship_id ?>&order_id=<?= $o->id ?>"><button class="check-button">Check</button></a>
                        </div>
                    </div>

                </div>
            <?php $count++;
            endforeach ?>


        </div>



        <input class="input" name="tabs" type="radio" id="tab-3" />
        <label class="label" for="tab-3">Shipping details</label>
        <div class="panel">
            <?php



            $getPending = $_db->prepare('
                SELECT * FROM `orders` WHERE user_id = ? AND status = ?
            ');

            $getPending->execute([$userID, "Pending"]);
            $results = $getPending->fetchAll();



            ?>




            <div class="product-container" style="padding:28px">
                <div class="product-details">
                    <div class="product-title"><%= r %>. Shipping ID : <%= ship[0] %></div>
                    <div class="product-description">Item will be arrived within <i style="color:green;text-decoration:underline;"> <%= ship[5] %></i> </div>
                    <div class="product-description">Address : <%= ship[4] %></div>
                    <div class="product-description">Recipient name : <%= ship[6] %></div>
                    <div class="product-description">Status : <%= ship[3] %></div>
                    <div class="product-description">Company : <%= ship[1] %></div>
                    <div class="product-description" style="color:rgb(77, 130, 24)">Fee:RM <%= ship[5] %></div>
                    <button class="rate-button" onclick="view_detail('<%= ship[0] %>', '<%= ship[5] %>')">View detail</button>
                </div>

            </div>


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
               WHERE o.status = ? AND o.user_id = ?
               ');

            $getPaid->execute(["Paid", $userID]);
            $results = $getPaid->fetchAll();



            ?>

            <?php $count = 0;
            foreach ($results as $o): ?>
                <div class="item-container">

                    <div class="item-details">
                        <img src="<?= $o->photo ?>" alt="" class="item-image" width="100" height="100">
                        <div class="item-text">
                            <h2>Product ID :<?= $o->product_id ?></h2>
                            <h3><?= $o->product_name  ?></h3>
                            <h3>unit : <?= $o->unit ?></h3>
                            <h3>price : <?= $o->odPrice ?></h3>
                            <p style="color:orangered">Subtotal :RM <?= $o->subtotal ?></p>
                        </div>

                    </div>

                    <a href="comment.php?id=<?= $o->product_id ?>"><button class="rate-button" style="width:150px">Rate</button></a>
                </div>
            <?php endforeach; ?>

        </div>

        <input class="input" name="tabs" type="radio" id="tab-5" />
        <label class="label" for="tab-5">Order</label>
        <div class="panel">
            <?php
            $stm = $_db->prepare('
                SELECT * FROM orders
                WHERE user_id = ?
            ');
            $stm->execute([$user->user_id]);
            $arr = $stm->fetchAll();
            ?>

            <h1>Order</h1>

            <p class="order-count">There has <?= count($arr) ?> orders(s)</p>

            <table class="order-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Order DateTime</th>
                        <th>Order Status</th>
                        <th>Total Amount</th>
                        <th>Total Quantity</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($arr as $i => $order): ?>
                        <tr>
                            <th><?php echo $i + 1; ?></th>
                            <td><?= $order->datetime ?></td>
                            <td><?= $order->status ?></td>
                            <td><?= $order->total ?></td>
                            <td><?= $order->count ?></td>
                            <td>
                                <button data-get="orderDetails.php?order_id=<?= $order->id ?>&user_id=<?= $order->user_id ?>" class="details-button">Detail</button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>




        </div>

    </div>


</body>
<script>


</script>

</html>