<?php
include '../_base.php';


auth('Member');
$cartSelect =  $_SESSION['cartSelection'];
$total = 0;

try {
    $wallet_id=generateID('wallet', 'wallet_id', 'W', 4);
    $wallet_stmt = $_db->prepare('
        INSERT INTO wallet (wallet_id, PIN, user_id) 
        VALUES (?, ?, ?)
    ');
    $wallet_stmt->execute([$wallet_id, "123456", $_SESSION['user']->user_id]);
} catch (PDOException $e) {
   //no time do le 
}

$productIds = array_keys($cartSelect);
$products = [];

if (!empty($productIds)) {

    $ids = implode(',', array_map(function ($id) {
        return "'" . htmlspecialchars($id, ENT_QUOTES) . "'";
    }, $productIds));

    $stmt = $_db->prepare("
      SELECT product_id, name, price
      FROM product 
      WHERE product_id IN ($ids)
  ");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


$getAddress = $_db->prepare('
    SELECT * FROM `address` WHERE user_id = ? 
');

$getAddress->execute([$_SESSION['user']->user_id]);
$resultsAddress = $getAddress->fetch();


if (is_post()) {

    $address = req('valueUpated');
    $shopnameOption = req('delivery_method');
    $shipMethod = req('shipMethod');
    $paymentMethod = req('payment');
    $phone = req('shippingPhone');
    $name = req('receipent_name');
    $count = req('count');
    $total = req('total');


    if (!$address) {
        $_err['valueUpated'] = 'Address is Required!**';
    }

    if (!$shopnameOption) {
        $_err['delivery_method'] = 'Please Select Delivery Company!**';
    }

    if (!$shipMethod) {
        $_err['shipMethod'] = 'Please Select Delivery Method!**';
    }

    if (!$paymentMethod) {
        $_err['payment'] = 'Please Select Payment Method!**';
    }


    if (!$_err) {

        $_db->beginTransaction();

        $shipid = generateID('shippers', 'ship_id', 'S', 4);
        $stm = $_db->prepare('
        INSERT INTO `shippers` (ship_id, address, company_name, phone, ship_method, status) 
        VALUES (?, ?, ?, ?, ?, ?)
    ');
        $stm->execute([$shipid, $address, $shopnameOption, $phone, $shipMethod, "Pending"]);

        $_SESSION['ship_id'] = $shipid;

        $_db->commit();

        $_db->beginTransaction();

        $orderid = generateID('orders', 'id', 'O', 4);
        $stm = $_db->prepare('
        INSERT INTO `orders` (id, datetime, user_id, ship_id, status, count, total) 
        VALUES (?, NOW(), ?, ?, ?, ?, ?)
    ');
        $total = floatval($total);
        $stm->execute([$orderid, $_SESSION['user']->user_id, $shipid, "Pending", $count, $total]);

        $stm = $_db->prepare('
        INSERT INTO order_details (order_id, product_id, price, unit, subtotal, commment_status)
        VALUES (?, ?, (SELECT price FROM product WHERE product_id = ?), ?, price * unit, ?)
    ');
        foreach ($cartSelect as $product_id => $unit) {
            $stm->execute([$orderid, $product_id, $product_id, $unit, "Pending"]);
            $stmt = $_db->prepare('SELECT quantity FROM product WHERE product_id = ?');
            $stmt->execute([$product_id]);
            $productStock = $stmt->fetch();
            $stmt = $_db->prepare('UPDATE product SET quantity = ? WHERE product_id = ?');
            $stmt->execute([ $productStock->quantity - $unit, $product_id]);
        }

        $_db->commit();

        $_db->beginTransaction();

        $pay_id = generateID('payment_record', 'id', 'PR', 4);
        $stm = $_db->prepare('
        INSERT INTO `payment_record` (id, user_id, amount, method, order_id) 
        VALUES (?, ?, ?, ?, ?)
    ');
        $stm->execute([$pay_id,  $_SESSION['user']->user_id, $total, $paymentMethod, $orderid]);

        $_db->commit();

        $stm = $_db->prepare('DELETE FROM `carts` WHERE user_id = ? AND product_id = ?');
        foreach ($cartSelect as $product_id => $unit) {
            $stm->execute([$_SESSION['user']->user_id, $product_id ]);
        }

        $_SESSION['order_id'] = $orderid;
        redirect('payment.php');
        exit();
    }
}

?>
<title>Check Out</title>

<link rel="stylesheet" href="../css/checkout.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>


<body class="body1">
    <?php
    include '../include/header.php';
    include '../include/sidebar.php';  ?>

    <div class="update-address-fill">

        <div class="address-form">
            <!-- <h1>Contact :</h1>
            <input type="text" id="receipent_namej" name="lname" placeholder="Name" />
            <input type="tel" id="shippingPhonej" name="lname" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" /> -->


            <h1>Address :</h1>

            <div id="maps" style="border:1px solid black"></div>
            <br>
            <div class="input-group">
                <input type="text" id="city" placeholder="City">
            </div>
            <div class="input-group">
                <select name="state" id="state">
                    <option value="">Select a state or territory</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Melaka">Melaka</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Kuala Lumpur,Wilayah Persekutuan">Wilayah Persekutuan</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Putrajaya">Putrajaya</option>
                </select>
            </div>
            <div class="input-group">
                <input type="text" id="unit" placeholder="unit">
            </div>
            <div class="input-group">
                <input type="text" id="location_name" placeholder="Details Location">
            </div>
            <div class="input-group">
                <input type="text" id="postal_code" placeholder="Postal Code">
            </div>
            <div class="input-group">
                <input type="text" id="street" placeholder="street">
            </div>
            <div class="input-group">
                <input type="text" id="country" placeholder="country">
            </div>


            <!-- <select name="state" id="state">
                <option value="">Select a state or territory</option>
                <option value="Johor">Johor</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Penang">Penang</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Kuala Lumpur,Wilayah Persekutuan">Kuala Lumpur,Wilayah Persekutuan</option>
                <option value="Labuan">Labuan</option>
                <option value="Putrajaya">Putrajaya</option>
            </select> -->
            <!-- 
            <div id="maps" style="border:1px solid black"></div>
            <input type="text" id="locationInput" placeholder="Enter location"> -->


            <div class="btn_slct">
                <button value="OK" id="ok" onclick="save_address()">SAVE</button>
                <button value="CANCEL" id="cancel" onclick="cancel()">CANCEL</button>
            </div>
        </div>

    </div>


    <form class="container" method="post">
        <div class="left">
            <h1>
                Checkout
            </h1>
            <?php $addressValues = $resultsAddress->street . ", " . $resultsAddress->postal_code . ", " . $resultsAddress->city . ", " . $resultsAddress->state . ", " . $resultsAddress->country;  ?>
            <div class="details">
                <div class="address-detail">
                    <div class="text-address">
                        <h2 class="Address" style="padding:5px 0;"><i class="material-icons" style="color:red;">place</i> Delivery Address</h2>
                        <h5 class="owner-address" style="color:black;">
                            <p> (Default Address)<?= $addressValues  ?></p>
                        </h5>
                        <p style="color:red;"><?= err('valueUpated') ?></p>
                    </div>

                    <div class="update-address" style="font-size: 15px;">
                        <p onclick="pop_up_form_address()"> Change address <i class="fa fa-angle-double-right"></i></p>
                    </div>

                    <input type="hidden" name="valueUpated" id="valueUpated" value="<?= $addressValues ?>" />


                </div>
                <div class="nice_border"></div>
            </div>
            <div class="details">
                <h2>
                    SHIPPING OPTION
                </h2>
                <div class="delivery-option">
                    <p style="color:red;padding:15px"><?= err('delivery_method') ?></p>
                    <div class="delivery-type">
                        <input type="radio" id="ninja" name="delivery_method" value="NINJA VAN">
                        <label for="ninja"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Ninjavan.svg/900px-Ninjavan.svg.png" width="70" height="40">
                            <p></p>
                        </label><br>
                        <input type="radio" id="pos" name="delivery_method" value="POS LAJU">
                        <label for="pos"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAwFBMVEXgHTP////TIDD++PngACfgFy/fAB/0v8PfACLgBSngGjHfACTeABjeABXfDyreAB3qgonhLT/jPEz87u/98/TdAAD41djwpKr63+HeABHRABzSGCrQAA/ulp3vnqTlUl/qeoPpcnz2x8vxrLHPAADSEibQABX75efhJzv52t3kR1bnZG/siZHyyMvqf4fmW2fobXfZSFP0ur/VMD3kQlLmVWLYRlHbWGHWOETljpTgcnncYWnzs7neanHWNEHtj5dcRRCvAAAKOElEQVR4nO2da2OiOBSGoRBECEGQCrRVUcb7pTNOO+103Z3//68WxSpgohBw27rn+TJ1JJDX3E5OkoMgJpi4wdNY+NpY3WVnkhQlHP50LawT7aNzWBYNER0LHYrCEKvoo3NXGZoqrzMKna755UsvhYafnaRCr04+OkuVQ/TJQaGHr6eCHkDm5F2hQ65RYCSRODuF3eurojGkGysMzY/OycXA4Vahel29aBJN3Sh01Y/OxwVR3UihdZ3dTAyyRMHDH52Li4I9wdU/OhMXRQ+F4FqHihgSCNNrboZRQ5wK1kfn4cJ89fkuAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACXRdtQPBVChJA6IegCx3m1UxS4DyK6grFKtOgvBZtq3uPxm2Tq2H6c9ZbzZW9qqdt7VIdG6qfQfd/PkVutrvhW4NZazaYkipLUHPXDZdfA+pl0SMf4sb2aOIk4JU4r/C5juTKRdfEcjrdwA1sx68xnEmw1+g4l6aRtY52d1bphtyeUZBGtuWZWdGhSls5KjHX25wjTao+m+kGLnW7UGdPDVWiy32DIi1lN/UqOvuZVuP1hA1XO5lMROok7OJ53nKzfNY411vU/Z5/sBUr2eRdWGCmYG6nfVZbd/Ve13y8/7x6+1SjJFnYmbgzye7RafUSzYdT/W4VRrese4k8gY/n+v+6vb3eD+/ubm5sHapUN1eQvUx+fqNcZjYFRsq4WVSiKHWNXHvJ7Phcvw7uNuJi7ETWnj4dfRnks8tDRjFLJL6pQbMnbJ5qz+GP/dXiQF3F/36Qmc/HulzGDog/sGiXGDg6F4kiLJBrt+O8faX0biT/p95zEo6qypH57koXNL5FHoTgykbHa/tV5yOqLGPygJ3OsqEnJjxwPdEoYc1wKxf7tYvNP88fdsb6NxL/oySSbIIvneWXiB/EpFONh7+2BKjDqbRg1UbJuc/eiCcIykUs4Fe54GTAkDn/TEzQbHE9plgqQVE6h+MqS+BCWum+KcjGuSiqUflJ6mi1U44YLt1yMKw6FqeGuOWBJpBs3dLxOMLXtx0ZncWzMjUpGCiyuUErn3BsyFDKMGwqtJ18nKKKum/5TO2O8lw09U1yhm/m8YHWoLOPm6IZ+UkM0KbZXyW/LxmGjKOxb9oHpzE1XnNVR5asxJTKMmzSen80TMsf9929HpQPNURTWMEpAVD8RKFSUKEaly5LIMm5SLClzQGTMdr/rU+mZPk2hkrkG9w5fzmnz8t+stsgybpLQ2xlB22LsZPNyGYUC3pdic0rN5Rvdeot6mzdOhYLmz5riyCgtMJ9CzXxviz3GKFfMuJGSXVCbVUxEDasI4ZVLoaDGUyWxecsqiV+FjJtF8sOUFfJQO+eMrFAhsuOv5szJ6wnjpn989SI1jgRGdd5RXoXa7jKVktsdxYyb9KA6aujmxSLI5lMomFv7pH97YoDzWL3NzfDYuJkfPfT7k6LUL6Eyp0K8zWTviS0wqnrfGArvb46MG5fiV3VqDcuvds2igEJlm8fbo58+nTC/cTNp02/RXPfGWK00zGPOdqhts3W7Oro4RX7jxumy7+KFM8Osru/Jp5Bs+1D39uRCg1jEuBmfNlkX8zGuqCTzKfS33eHs9qwr/o01LGaNm+nZ2WOrhyuJfpxLod7bfmGR83OFV+aYkR75l9lJGAWpgyrQmEehHI/3Es7hCewzx4xB6kl/8jm+O2bpunpWoUb8WXyN59s58sSc8g9T1kLnOZdC0ZmV8egzFK5ulQOyNnvPWd+gTyzSvLCq6SBlg7u5PcPrkovBFIVSM0Gib1njPAqZfc0g5SoNzbwKRa+cQVfAT+OaeRT+yFmGzFnKMU2tjMQCCjtKnnbIGvRvhqkpU6eAwnIOxQIK2+r4/EUrVl96f5O67s9tXl/jhn6JhYsiCvXzF0s3zGliqgjFoK4G5yykBD3+QaNIO1SNsw7QH0xvRid94RMSiGFnvb9MSizOFFAYqubizCVsj1R2uW28aVlIx+Nglau6Lrn3ZBRQ2FfUM6YW2/B+yVy5LxONKP44WJ9VOeFuiQUUtjA5bWqFzMnTa/bSfrLWaUTFQm99usaOebvTAgodrJ3sTNkLGDdHc5L20eYqohrj4MSKHHc1LbIyM9bwidpUaBGK6giNaqzZY82q1ryvWSmi8Bmp7JVdp4ivzTlajXkn6mDp3dmCtzctotDVEdOqKbYYfKpAkE/1Bo14u5r8CqVVVLUMVneQeyDc0kXkxBDurylJHN4ljDwKpaZXaz/7StR2ZIa3jT0Q0jZfjAzSWLJ3q1FrilRhGdaQlWKMFKzEe9n2zu8MBZfXGnVjIk6mrDfBaQIlTbPCMqyZJ/azUwd99kD4iyZQ8uOdUTWLPrlFNMcz9/uOcnqE92jo+OH9gsvcc1nfOYRXNs1naNJ+xT7vWmlRhfuFtgMTVhW9H1At9aaiGXsTYDHzlYwjX6Z22B3eNzoVViiYmWyzF52G9OnRjJBe4qOz+i7g/XkHrW7MqAXf5Z3nF1dI0l6yYguH4sahJRhZI8cLA8s3MMb+eEk3ari7Ug6FmWZSbPE3KjJZq/eo3zQ9z2OOXSH3u/E4FApmYtj/u+juxGci+Pl2EqWwuZ1RPAoR2ieaM0f6v+k5nSuCksOhn2XF76jhUSiQd7cieyBk7BUKDbrFcg7u2SGnQkGP9+lPvjF6GdZ+r1VkmPh5fTMJghIv/+NTKKjxfvTFgNoMWXv21n782tCirMpsHOJUKOjTbULpjVaMQ3oxtaOMyhxnEVqlXlDJq1AgQiyj9Xp04OKBPoft4Y1Rneu8U1qgUmr1iVuhgN7rW+2fh1RdpQ+EI3vblpB8/sxaJju48j3CORVGTaq7s00my/vh3najD4Tt922ymo7bRTTOmQ6P/0ChQMz9BH7x++dweDcY3FN3Iy7s5D1VMs875rfs0u/5LaUwyiw6VElnES7/eqGM9K3sEUtN9md59rl7j375XVIlFW4PkZ4ukBV1Lk+wvT5TWRePlWw4oZx0LjjX1HTjec0S2Q9khVEMSFF7NWbPOvljVbShBi0bWWaFawZSzGk7e1RCarkz2Ty1TU0jitLtTLJFKU3CnoblynbxHZ/H57o1kk1f6H5vdMIId957tHCuyAFIx6b9vR3WFotFfxWlzJvwQ9AQqetqhC4Xiv6AiKwqZoSi6vWL7TMFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD4X2F9dAYujCVUEYD/E4OmwrLSANmfDrIUwhLH2b8Aeih4FbwI4xODPUG0rrkhIksURLf0eeFPjOpGCsVKopt/TjRT2igMS7826dOyCXywCX9W7v1znxiyecvCRqGDrrOzQcjZKRQ91qnxLw2KIzrFQfpG6PoqKqnHAVZ2YQidack3CX46zO4uBsA+0GKoX9GooanGPiZHIpSkO8b6FZx414iOx4mXuqeCZU7cYPrV54tjO3BTEQv/BRfZyYyGUJXuAAAAAElFTkSuQmCC" width="70" height="40">
                            <p></p>
                        </label><br>
                        <input type="radio" id="jT" name="delivery_method" value="J&T">
                        <label for="jT"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/J%26T_Express_logo.svg/2560px-J%26T_Express_logo.svg.png" width="70" height="40">
                            <p></p>
                        </label>
                    </div>
                </div>

            </div>
        </div>
        <div class="right">
            <h2>
                YOUR ORDER
            </h2>

            <div class="order-summary">
                <table class="table-list">
                    <tr>
                        <th>No.</th>
                        <th>Product</th>
                        <th>Price X Unit</th>
                        <th>Poster</th>
                    </tr>

                    <?php
                    $subtotal = 0;
                    $count = 0;
                    $discount = 0;
                    foreach ($products as $product):

                        $productId = $product['product_id'];
                        $quantity = isset($cartSelect[$productId]) ? $cartSelect[$productId] : 0;
                        $subtotal += $product['price'] * $quantity;

                        $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
                        $getProductImg->execute([$productId]);
                        $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
                        $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';
                    ?>
                        <tr>
                            <td><?= $count + 1 ?></td>
                            <td><?= $product['name'] ?></td>
                            <td>RM <?= $product['price'] ?> X <?= $quantity ?></td>
                            <td style="width:100px;height:100px;">
                                <img src="../uploads/<?= $productPhoto ?>" class="poster-img" style="width:100%;height:100%;">
                            </td>
                        </tr>
                    <?php
                        $count += 1;
                    endforeach;
                    ?>
                    <input type="hidden" name="count" value="<?= $count ?>">



                    <tr class="total-row">

                        <td colspan="2">Subtotal</td>
                        <td colspan="1">RM <?= $subtotal = number_format($subtotal, 2, '.', ''); ?></td>
                    </tr>
                </table>
                <div class="totals">
                    <table class="payment_checking">


                        <tr>
                            <th>Merchandise Subtotal</th>
                            <td>RM <?= $subtotal = number_format($subtotal, 2, '.', ''); ?></td>
                        </tr>
                        <tr>
                            <th>Shipping Fee </th>
                            <td>
                                <div class="optShip" style="text-align: center;gap:25px;display:flex;">
                                    <label>
                                        <input type="radio" name="shipMethod" value="pick" class="shipMethod">
                                        RM1.60 (Self Pickup)
                                    </label>
                                    <label>
                                        <input type="radio" name="shipMethod" value="door" class="shipMethod">
                                        RM4.60 (Step Door)
                                    </label>
                                    <p style="color:red;"><?= err('shipMethod') ?></p>
                                </div>
                            </td>
                        </tr>



                        <?php if ($subtotal > 2000) {
                            $discount = ($subtotal * 0.05);
                        ?>
                            <tr>
                                <th>Discount (5%)</th>
                                <td>(-) RM <?= number_format($discount, 2, '.', ''); ?> </td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <?php
                            $tax = ($subtotal * 0.02);
                            ?>
                            <th>Service Tax (2%) </th>

                            <td>RM <?= number_format($tax, 2, '.', '') ?></td>
                        </tr>
                        <tr>

                            <th style="font-size: 15px">TOTAL</th>
                            <?php $totalpay = $subtotal - $discount + $tax; ?>
                            <td class="totalPrice" style="color:red; font-size: 15px; font-family: 'Brush Script MT', cursive;">
                                <p id="pays"> RM<?= number_format($totalpay, 2, '.', '') ?></p>
                            </td>
                            <input type="hidden" id="totals" name="total">

                        </tr>


                    </table>
                    <div class="selected_payment_method">
                        <h1>Payment Option</h1>
                        <p style="color:red;padding:20px;"><?= err('payment') ?></p>

                        <div class="box_select">
                            <input type="radio" name="payment" id="VisaMasterCard" class="invisible" value="card">
                            <input type="radio" name="payment" id="E-Wallet" class="invisible" value="eWallet">
                            <input type="radio" name="payment" id="Cash" class="invisible" value="Cash">

                            <div class="category_payment">
                                <label id="lab1" for="VisaMasterCard" class="VM">
                                    <div class="imgName">
                                        <div class="imageContainer">
                                            <img id="img1" src="https://4a7efb2d53317100f611-1d7064c4f7b6de25658a4199efb34975.ssl.cf1.rackcdn.com/visa-mastercard-agree-to-give-gas-pumps-break-on-emv-shift-showcase_image-9-p-2335.jpg" alt="" width="300" height="200">

                                        </div>
                                    </div>
                                    <h5 style="padding: 5px;">Credit/Debit Card</h5>
                                    <span class="check"><box-icon name='check-double' color=#3fa5f3 size="30px"></box-icon></span>
                                </label>

                                <label id="lab1" for="E-Wallet" class="Ewallet">
                                    <div class="imgName">
                                        <div class="imageContainer">
                                            <img id="img1" src="data:image/png;base64,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" alt="" width="90" height="90">

                                        </div>
                                    </div>
                                    <h5 style="padding: 5px;">Digital Wallet</h5>
                                    <span class="check"><box-icon name='check-double' color=#3fa5f3 size="30px"></span>
                                </label>

                            </div>


                        </div>
                    </div>
                </div>
                <button class="gift-code">
                    PLACE ORDER
                </button>
            </div>
        </div>
        </div>

    </form>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="../js/checkout.js"></script>
    <script src="../js/map.js"></script>
    <script>


    </script>
</body>

</html>