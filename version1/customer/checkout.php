<?php
include '../_base.php';
include '../include/header.php';
$cartSelect =  $_SESSION['cartSelection'];
$total = 0;

$productIds = array_keys($cartSelect);
$products = [];

if (!empty($productIds)) {
  $ids = implode(',', array_map('intval', $productIds));

  $stmt = $_db->prepare("
        SELECT product_id, name, price, product_photo 
        FROM product 
        WHERE product_id IN ($ids)
    ");
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


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

    $stm = $_db->prepare('
    INSERT INTO `shippers` (address,company_name,phone,ship_method) VALUES (?, ? ,? , ?)
    ');

    $stm->execute([$address, $shopnameOption, $phone, $shipMethod]);
    $ship_id = $_db->lastInsertId();

    $_db->commit();

    $_db->beginTransaction();
    $stm = $_db->prepare('
    INSERT INTO `orders` (datetime,user_id,ship_id,status,count,total) VALUES (NOW(), ?, ?, ?, ?, ?)
    ');

    $total = floatval($total);
   
    $stm->execute([$userID, $ship_id, "Pending", $count, $total]);
    $id = $_db->lastInsertId();

    $stm = $_db->prepare('
    INSERT INTO order_details (order_id,product_id,price,unit,subtotal)
    VALUES (?,?,(SELECT price FROM product WHERE product_id = ?),?,price * unit)
    ');

    foreach ($cartSelect as $product_id => $unit) {
      $stm->execute([$id, $product_id, $product_id, $unit]);
    }

    $_db->commit();

    $stm = $_db->prepare('
    INSERT INTO `payment_record` (user_id,amount,method,order_id) VALUES (?, ? ,? , ?)
    ');

    $stm->execute([$userID, $total, $paymentMethod, $id]);
  
    $_SESSION['order_id'] = $id;
    redirect('payment.php');
    exit();
  }
}

?>
<title>Check Out</title>

<link rel="stylesheet" href="../css/checkout.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>


<body class="body1">


  <div class="update-address-fill">

    <div class="address-form">
      <h1>Contact :</h1>
      <input type="text" id="receipent_namej" name="lname" placeholder="Name" />
      <input type="tel" id="shippingPhonej" name="lname" placeholder="Phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" />


      <h1>Address :</h1>


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
        <option value="Kuala Lumpur,Wilayah Persekutuan">Kuala Lumpur,Wilayah Persekutuan</option>
        <option value="Labuan">Labuan</option>
        <option value="Putrajaya">Putrajaya</option>
      </select>

      <div id="maps" style="border:1px solid black"></div>
      <input type="text" id="locationInput" placeholder="Enter location">


      <div class="btn_slct">
        <button value="OK" id="ok" onclick="save_address()">SAVE</button>
        <button value="CANCEL" id="cancel" onclick="cancel()">CANCEL</button>
      </div>
    </div>

  </div>

  <!-- Invisible box 1 -->

  <div class="custom-alert-container">
    <div id="customAlert" class="custom-alert">
      <span id="closeBtn" class="close-btn" onclick="closeCustomAlert()">&times;</span>
      <h2 id="alertTitle"><img src="../Image/warning.png" width="70" height="70"></h2>
      <p id="alertMessage"></p>
    </div>
  </div>

  <!-- Invisible box 2 -->

  <!-- Invisible box 3 -->

  <form class="container" method="post">

    <h1 class="check-out-text" style="padding:10px 0;">Check Out</h1>

    <div class="address-detail">
      <div class="text-address">
        <h2 class="Address" style="padding:5px 0;"><i class="material-icons" style="color:red;">place</i> Delivery Address</h2>
        <h5 class="owner-address" style="color:black;">
          <p> Please enter your current address for delivery</p>
        </h5>
        <p style="color:red;"><?= err('valueUpated') ?></p>
      </div>


      <div class="update-address" style="font-size: 20px;">
        <p onclick="pop_up_form_address()"> Enter your address <i class="fa fa-angle-double-right"></i></p>
      </div>

      <input type="hidden" name="valueUpated" id="valueUpated" />
      <input type="hidden" name="shippingPhone" id="shippingPhone" />
      <input type="hidden" name="receipent_name" id="receipent_name" />

    </div>
    <div class="nice_border"></div>
    <!-----End of box 1-->

    <div class="check-out-container">

      <h1 style="padding:20px 0"><img src="../Image/clipboard.png" weight="50" height="50"> Your Orders :</h1>

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

        ?>
          <tr>
            <td><?= $count + 1 ?></td>
            <td><?= $product['name'] ?></td>
            <td>RM <?= $product['price'] ?> X <?= $quantity ?></td>
            <td style="width:100px;height:100px;">
              <img src="../uploads/<?= $product['product_photo'] ?>" class="poster-img" style="width:100%;height:100%;">
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

    </div>

    <!-----End of box 2-->
    <div class="shadow" style="  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
      <div class="delivery-option">
        <h1 style="padding:10px;"><img src="../Image/delivery-truck.png" weight="50" height="50"> Shipping Options </h1>
        <p style="color:red;padding:15px"><?= err('delivery_method') ?></p>
        <div class="delivery-type">
          <input type="radio" id="ninja" name="delivery_method" value="NINJA VAN">
          <label for="ninja"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Ninjavan.svg/900px-Ninjavan.svg.png" width="150" height="50">
            <p></p>
          </label><br>
          <input type="radio" id="pos" name="delivery_method" value="POS LAJU">
          <label for="pos"><img src="data:image/png;base64,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" width="150" height="50">
            <p></p>
          </label><br>
          <input type="radio" id="jT" name="delivery_method" value="J&T">
          <label for="jT"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/01/J%26T_Express_logo.svg/2560px-J%26T_Express_logo.svg.png" width="150" height="50">
            <p></p>
          </label>
        </div>
      </div>
      <!-----End of box 3-->
      <div class="payment-detail">
        <h1 style="padding:25px;text-align: center;"><i class="fa fa-credit-card" style="font-size:24px"></i> Payment Details</h1>
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

            <th style="font-size: 30px">TOTAL</th>
            <?php $totalpay = $subtotal - $discount + $tax; ?>
            <td class="totalPrice" style="color:red; font-size: 30px; font-family: 'Brush Script MT', cursive;">
              <p id="pays"> RM<?= number_format($totalpay, 2, '.', '') ?></p>
            </td>
            <input type="hidden" id="totals" name="total">

          </tr>


        </table>
      </div>
      <!-----End of box 4-->
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
              <h3 style="padding: 15px;">Credit/Debit Card</h3>
              <span class="check"><box-icon name='check-double' color=#3fa5f3 size="30px"></box-icon></span>
            </label>

            <label id="lab1" for="E-Wallet" class="Ewallet">
              <div class="imgName">
                <div class="imageContainer">
                  <img id="img1" src="../Image/wallet.png" alt="" width="90" height="90">

                </div>
              </div>
              <h3 style="padding: 15px;">Digital Wallet</h3>
              <span class="check"><box-icon name='check-double' color=#3fa5f3 size="30px"></span>
            </label>

          </div>


        </div>
      </div>
    </div>
    <!-----End of box 5-->

    <div class="btn_back_proceed">
      <a class="buttonb" id="backButton" href="#">Back</a>
      <div class="button">
        <button>Place Order →</button>
      </div>

    </div>
  </form>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="../js/checkout.js"></script>
  <script src="../js/map.js"></script>
  <script>


  </script>
</body>

</html>