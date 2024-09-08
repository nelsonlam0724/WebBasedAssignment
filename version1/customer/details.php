<?php
include '../_base.php';
include '../include/header.php';

$order_id = get('order_id');
$ship_id = get('ship_id');


$getItems = $_db->prepare('
    SELECT o.* , p.name , p.product_photo 
    FROM order_details AS o 
    JOIN product AS p ON o.product_id = p.product_id
    WHERE o.order_id = ?
');

$getItems->execute([$order_id]);
$results = $getItems->fetchAll(PDO::FETCH_ASSOC);




$getShip = $_db->prepare('
SELECT * FROM `shippers` WHERE ship_id = ?
');

$getShip->execute([$ship_id]);
$resultss = $getShip->fetchAll();
?>


<link rel="stylesheet" href="../css/details.css">

</head>

<body>
    <div class="receipt">
        <h2>Your Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

                <?php $count = 0;
                $subtotal = 0;
                $discount = 0;
                foreach ($results as $o): ?>
                    <tr>
                        <td><img src="../uploads/<?= $o['product_photo'] ?>" width="90" height="90"></td>
                        <td><?= $o['name'] ?></td>
                        <td><?= $o['unit'] ?></td>
                        <td>RM<?= $o['price'] ?></td>
                        <td>RM <?= $o['subtotal'] ?></td>
                        <?php $subtotal +=  $o['subtotal']; ?>
                    </tr>
                <?php $count++;
                endforeach ?>

            </tbody>
            <tfoot>
                <?php if ($subtotal > 2000) {
                    $discount = ($subtotal * 0.05);
                ?>
                    <tr>
                        <th colspan="5">Discount (5%)</th>
                        <td>(-) RM <?= number_format($discount, 2, '.', ''); ?> </td>
                    </tr>
                <?php } ?>

                <tr>
                    <?php
                    $tax = ($subtotal * 0.02);
                    ?>
                    <th colspan="5">Service Tax (2%) </th>

                    <td>RM <?= number_format($tax, 2, '.', '') ?></td>
                </tr>
               <?php foreach ($results as $o): 
                $totalpay = $subtotal - $discount + $tax;
                 if(isset($o->ship_method) && $o->ship_method == "pick"){ 
                       $fee =4.60;
                    $totalpay += $fee;
                 }else{
                    $fee = 1.60;
                       $totalpay += $fee;
                    }
                    ?>
                <tr>                     
                    <td>RM <?= number_format($fee, 2, '.', '') ?></td>
                </tr>
                <?php 
                endforeach ?>

                <tr>
                    <td colspan="5">Total:</td>

   
                    <td> RM<?= number_format($totalpay, 2, '.', '') ?></td>
                </tr>
            </tfoot>
        </table>






        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

                <?php $count = 0;
                $subtotal = 0;
                $discount = 0;
                foreach ($results as $o): ?>
                    <tr>
                        <td><img src="../uploads/<?= $o['product_photo'] ?>" width="90" height="90"></td>
                        <td><?= $o['name'] ?></td>
                        <td><?= $o['unit'] ?></td>
                        <td>RM<?= $o['price'] ?></td>
                        <td>RM <?= $o['subtotal'] ?></td>
                        <?php $subtotal +=  $o['subtotal']; ?>
                    </tr>
                <?php $count++;
                endforeach ?>

            </tbody>

        </table>
    </div>
</body>

</html>