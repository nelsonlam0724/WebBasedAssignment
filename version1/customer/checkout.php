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

  <form class="container" method="get" action="/PlayTime/paymentServlet" onsubmit="return validForm()">

    <h1 class="check-out-text" style="padding:10px 0;">Check Out</h1>

    <div class="address-detail">
      <div class="text-address">
        <h2 class="Address" style="padding:5px 0;"><i class="material-icons" style="color:red;">place</i> Delivery Address</h2>
        <h5 class="owner-address" style="color:red;">
          <p> Please enter your current address for delivery </p>
        </h5>
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
        <h1 style="padding:10px;"><img src="../Image/delivery-truck.png" weight="50" height="50"> Shipping Options</h1>
        <div class="delivery-type">
          <input type="radio" id="ninja" name="delivery_method" value="NINJA VAN">
          <label for="ninja"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5d/Ninjavan.svg/900px-Ninjavan.svg.png" width="150" height="50">
            <p><%= fee %></p>
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
            <td>RM <?=  $subtotal = number_format($subtotal, 2, '.', ''); ?></td>
          </tr>
          <tr>
            <th>Shipping Fee </th>
            <td> <div class="optShip" style="text-align: center;gap:25px;display:flex;">
        <label>
            <input type="radio" name="payment">
             RM1.60 (Self Pickup)
        </label>
        <label>
            <input type="radio" name="payment" checked>
            RM4.60 (Step Door)
        </label>
      
    </div></td>
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
        <div class="box_select">
 
        <h2 class="title">Payment Method</h2>
        <div class="logos">
            <img src="https://w7.pngwing.com/pngs/363/177/png-transparent-visa-mastercard-logo-visa-mastercard-computer-icons-visa-text-payment-logo-thumbnail.png" alt="Visa and MasterCard logos" id="card-logo">
            <img src="https://is1-ssl.mzstatic.com/image/thumb/Purple221/v4/14/80/fe/1480feec-244b-6888-a853-99c37334d546/AppIcon-1x_U007emarketing-0-5-0-0-85-220-0.png/1200x630wa.png" alt="PayPal logo" id="paypal-logo">
        </div>

        <div id="card-form" class="hidden">
            <div class="form-group">
                <label for="name">Name on Card</label>
                <input id="name" type="text" value="John Smith">
            </div>
            <div class="form-group">
                <label for="card">Card Number</label>
                <input id="card" type="text" value="0000-0000-0000-0000">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input id="cvv" type="text" value="">
                </div>
                <div class="form-group">
                    <label for="date">Expiration Date</label>
                    <input id="date" type="text" value="MM/YY">
                </div>
            </div>
        </div>

            <div id="paypal-form" class="hidden">
            <div class="form-group">
                <label for="paypal-email">PayPal Email</label>
                <input id="paypal-email" type="email" placeholder="example@paypal.com">
            </div>
            
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
  <script src="../js/payment.js"></script>
  <script src="../js/map.js"></script>
  <script>
        $(document).ready(function() {
            $('#card-logo').click(function() {
                $('#card-form').removeClass('hidden');
                $('#paypal-form').addClass('hidden');
            });

            $('#paypal-logo').click(function() {
                $('#paypal-form').removeClass('hidden');
                $('#card-form').addClass('hidden');
            });
        });
    </script>
  <script>

  </script>
</body>

</html>