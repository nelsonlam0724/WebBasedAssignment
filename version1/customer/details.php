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
$resultss = $getShip->fetch();


$_SESSION['ship_id']=$ship_id;
$_SESSION['order_id'] = $order_id;
?>


<link rel="stylesheet" href="../css/details.css">
<style>
    p{
        padding:10px;
    }

    span{
        color:gray;
    }
    .payment-button {
    text-align: center;
    margin-top: 20px;
}

.payment-button button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.payment-button button:hover {
    background-color: #3e8e41;
}
</style>
</head>

<body>
    <div class="receipt">
        <h2>Your Orders : <?= $order_id ?></h2>
        <p>Shipping name     : <span><?= $resultss->company_name ?></span></p>
        <p>Shipping address : <span><?= $resultss->address ?></span></p>
        <p>Shipping method   : <span><?= $resultss->ship_method ?></span></p>
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

                <?php 
                $items_order =[];
                $count = 0;
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
                <?php 
                  $items_order[$o['product_id']] = $o['unit'];
                $count++;
                endforeach ?>

            </tbody>
            <tfoot>
                <?php 
                $_SESSION['cartSelection']= $items_order;

                if ($subtotal > 2000) {
                    $discount = ($subtotal * 0.05);
                ?>
                    <tr>
                        <th colspan="4">Discount (5%)</th>
                        <td>(-) RM <?= number_format($discount, 2, '.', ''); ?> </td>
                    </tr>
                <?php } ?>

                <tr>
                    <?php
                    $tax = ($subtotal * 0.02);
                    ?>
                    <th colspan="4">Service Tax (2%) </th>

                    <td>RM <?= number_format($tax, 2, '.', '') ?></td>
                </tr>
               <?php 
                $totalpay = $subtotal - $discount + $tax;
                 if(isset($resultss->ship_method) && $resultss->ship_method == "pick"){ 
                       $fee =1.60;
                       $totalpay += $fee;
                 }else{
                     $fee = 4.60;
                       $totalpay += $fee;
                    }
                    ?>
                <tr>    
                   <td colspan="4">Ship Fee:</td>                 
                    <td>RM <?= number_format($fee, 2, '.', '') ?></td>
                </tr>
   
                <tr>
                    <td colspan="4">Total:</td>
                    <td> RM<?= number_format($totalpay, 2, '.', '') ?></td>
                </tr>
            </tfoot>
        </table>

        <div class="payment-button">
    <form action="payment.php" method="get">
        <input type="hidden" name="order_id" value="<?= $order_id ?>">
        <input type="hidden" name="totalpay" value="<?= $totalpay ?>">
        <button type="submit">Pay Now (RM <?= number_format($totalpay, 2, '.', '') ?>)</button>
    </form>
</div>




      
    </div>
</body>

</html>