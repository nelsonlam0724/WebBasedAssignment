<?php 
include '../_base.php';



?>
<title>Payment</title>
<link rel="stylesheet" href="../css/payment.css">
</head>

<body>

<form class="container">
<div id="card-form" class="hidden">
            <div class="form-group">
                <label for="name">Name on Card</label>
                <input id="name" type="text" value="xiao mm">
            </div>
            <div class="form-group">
                <label for="card">Card Number</label>
                <input id="card" type="text" value="0000-0000-0000-0000">
            </div>
            <div class="form-row" >
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

            <div style="display:flex;gap:20px;">
   <div class="button">
        <button>Pay →</button>
      </div>
      <div class="button">
        <div>Later </div>
      </div>
            </div>
</div>
</form>

</body>
<script>document.querySelector("link[href='../css/header.css']").removeAttribute('disabled');</script>
</html>
