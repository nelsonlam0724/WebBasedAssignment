<?php 
include '../_base.php';
auth('Member');
$order= $_SESSION['order_id'];
$getPayment = $_db->prepare('
    SELECT * FROM payment_record WHERE order_id = ?
');
$getPayment->execute([$order]);
$resultss = $getPayment->fetch();
?>

<title>Payment</title>
<link rel="stylesheet" href="../css/payment.css">
</head>
<body>

<div class="container">
<?php 
$result = strcmp($resultss->method , "card");
if($result == 0){                  
    include '../payment/bank.php';
 }else{  
    include '../payment/wallet.php';
  } ?>      
            
</div>

</body>
<script>
document.querySelector("link[href='../css/header.css']").removeAttribute('disabled');
history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  }

</script>
</html>
