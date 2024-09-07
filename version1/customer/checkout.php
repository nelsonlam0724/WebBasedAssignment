<?php
include '../_base.php';
include '../include/header.php';
$cartSelec =  $_SESSION['cartSelection'];

$productIds = array_keys($cartSelec);
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

// var_dump($cartSelec);

if (is_post()) {

  $address = req('valueUpated');
  $shopnameOption = req('delivery_method');
  $shipMethod = req('shipMethod');
  $paymentMethod = req('payment');


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
       redirect('payment.php');
  }
}

?>
<title>Check Out</title>

<link rel="stylesheet" href="../css/checkout.css">
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

      <div id="map"></div>
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
        $count = 1;
        foreach ($products as $product):


          $productId = $product['product_id'];
          $quantity = isset($cartSelec[$productId]) ? $cartSelec[$productId] : 0;
          $subtotal += $product['price'] * $quantity;

        ?>
          <tr>
            <td><?= $count ?></td>
            <td><?= $product['name'] ?></td>
            <td>RM <?= $product['price'] ?> X <?= $quantity ?></td>
            <td style="width:100px;height:100px;">
              <img src="<?= $product['product_photo'] ?>" class="poster-img" style="width:100%;height:100%;">
            </td>
          </tr>
        <?php
          $count++;
        endforeach; ?>


        <tr class="total-row">

          <td colspan="2">Subtotal</td>
          <td colspan="1">RM <?= $subtotal = number_format($subtotal, 2, '.', ''); ?></td>
        </tr>
      </table>

    </div>

    <!-----End of box 2-->
    <div class="shadow" style="  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
      <div class="delivery-option">
        <h1 style="padding:10px;"><img src="../Image/delivery-truck.png" weight="50" height="50"> Shipping Options   </h1><p style="color:red;padding:15px"><?= err('delivery_method') ?></p>
        <div class="delivery-type">
          <input type="radio" id="ninja" name="delivery_method" value="NINJA VAN">
          <label for="ninja"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Ninjavan.svg/900px-Ninjavan.svg.png" width="150" height="50">
            <p></p>
          </label><br>
          <input type="radio" id="pos" name="delivery_method" value="POS LAJU">
          <label for="pos"><img src="../Image/poslaju.png" width="150" height="50">
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
            <th>OrderID </th>
            <td>ID <%= order_id  %></td>
          </tr>
          <tr>
            <th>Merchandise Subtotal</th>
            <td>RM <?= $subtotal = number_format($subtotal, 2, '.', ''); ?></td>
          </tr>
          <tr>
            <th>Shipping Fee </th>
            <td>
              <div class="optShip" style="text-align: center;gap:25px;display:flex;">
                <label>
                  <input type="radio" name="shipMethod">
                  RM1.60 (Self Pickup)
                </label>
                <label>
                  <input type="radio" name="shipMethod" >
                  RM4.60 (Step Door)
                </label>
                <p style="color:red;"><?= err('shipMethod') ?></p>
              </div>
            </td>
          </tr>

          <tr>

            <th>Discount (<%= checkDiscount.getDiscountRate() %>)</th>
            <td>(-) RM <%= discount %> </td>
          </tr>

          <tr>
            <th>Service Tax (2%) </th>

            <td>RM <%= tax %></td>
          </tr>
          <tr>

            <th style="font-size: 30px">TOTAL</th>
            <td class="totalPrice" style="color:red;font-size: 30px;font-family: 'Brush Script MT', cursive;">RM <%= totalpay %></td>
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
            <label id="lab1" for = "VisaMasterCard" class="VM">
              <div class="imgName">
                            <div class="imageContainer">
                                      <img id="img1" src="../Image/VISA-MASTER.png" alt="" width="300" height="200">
                                      
                            </div>
              </div>
              <h3 style="padding: 15px;">Credit/Debit Card</h3>
              <span class="check"><box-icon name='check-double' color= #3fa5f3 size="30px"></box-icon></span>
            </label>

            <label id="lab1" for="E-Wallet" class="Ewallet">
              <div class="imgName">
                <div class="imageContainer">
                          <img id="img1" src="../Image/wallet.png" alt="" width="90" height="90">
                   
                </div>
            </div>
            <h3 style="padding: 15px;">Digital Wallet</h3>
           <span class="check"><box-icon name='check-double' color= #3fa5f3 size="30px"></span>
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
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="../js/checkout.js"></script>
  <script src="../js/map.js"></script>

</body>

</html>