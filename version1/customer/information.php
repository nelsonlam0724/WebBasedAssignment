<?php
include '../_base.php';
include '../include/header.php';


$getPending = $_db->prepare('
    SELECT * FROM `orders` WHERE user_id = ? AND status = ?
');

$getPending->execute([$userID, "Pending"]);
$results = $getPending->fetchAll();



?>

<link rel="stylesheet" href="../css/information.css">

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



            <div class="item-container">

                <div class="item-details">
                    <img src="<%= rate[3] %>" alt="" class="item-image" width="100" height="100">
                    <div class="item-text">
                        <h2>Payment ID :<%= rate[0] %></h2>
                        <h3><%= rate[1] %></h3>
                        <p>RM <%= rate[2] %></p>
                        <p> <%= rate[5] %></p>
                    </div>

                </div>

                <button class="rate-button" style="width:150px" onclick="goRate('<%= rate[0] %>','<%= rate[4] %>')">Rate</button>
            </div>

        </div>

    </div>
</body>
<script>


</script>

</html>