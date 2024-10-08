<?php
include '../_base.php';
auth('Member');
$cartSelect =  $_SESSION['cartSelection'];
$total = 0;

$productIds = array_keys($cartSelect);
$products = [];

if (!empty($productIds)) {
  $ids = implode(',', array_map(function($id) {
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


$getShip = $_db->prepare('
SELECT * FROM `shippers` WHERE ship_id = ?
');
$getShip->execute([$_SESSION['ship_id'] ]);
$resultss = $getShip->fetch();

$getPayRecord = $_db->prepare('
SELECT * FROM `payment_record` WHERE order_id = ?
');
$getPayRecord->execute([$_SESSION['order_id'] ]);
$recordResult = $getPayRecord->fetch();
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Online Payment Receipt</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<link rel="stylesheet" href="../css/receipt.css">

</head>
<body>

<div class="container">
 <div class="pdfGenerator" style="padding:10px">
    <div class="brand"  style="display: block; margin: 0 auto;">
                <h1 style="color:black"> QIAN<span style="color:red">HO</span></h1>
            </div>
    <h1>Online Payment Receipt</h1>
  <div class="receipt-info">
    <div>
    <p><strong>Order Id : </strong><span style="color:grey"> <?=  $_SESSION['order_id'] ?></span></p>
    <p><strong>Date/Time : </strong><span style="color:grey">Paid at <?=  $recordResult->datetime ?></span></p>
    <p><strong>Payment Method : </strong><span style="color:grey"><?= $recordResult->method ?></span></p>
    <p><strong>Delivery name  : </strong><span style="color:grey"> <?= $resultss->company_name ?> </span></p>
    </div>
    <p><strong>Destination :</strong>  <span style="color:grey;"><?= $resultss->address ?></span> </p>
    <p><strong>Name:</strong>  <span style="color:grey;"><?= $_SESSION['user']->name?></span> </p>
    <p><strong>Contact Number :</strong>  <span style="color:grey;"><?=  $_SESSION['user']->contact_num ?></span> </p>
  </div>

  
  <div class="order-list">
    <h2>Order List</h2>
    <table>
      <thead>
        <tr>
        <th>No.</th>
        <th>Image</th>
          <th>Item</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
          
  
      <?php
        $subtotal = 0;
        $count = 0;
        $discount = 0;
        $totalpay = 0;
        foreach ($products as $product):


          $productId = $product['product_id'];

          $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
          $getProductImg->execute([$productId]);
          $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
          $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';  

          $quantity = isset($cartSelect[$productId]) ? $cartSelect[$productId] : 0;
          $subtotal += $product['price'] * $quantity;

          ?>
        <tr>
          <td><?= $count + 1 ?></td>
          <td><img src="../uploads/<?= $productPhoto?>" alt="" width="80" height="80"></td>
          <td><?= $product['name'] ?></td>
          <td><?= $quantity?></td>
          <td><?= $product['price']  ?></td>
          <td><?=  number_format($product['price'] * $quantity, 2, '.', '') ?></td>
        </tr>
        <?php
          $count += 1;
        endforeach;
        ?>
          
    
        
      </tbody>
    </table>
  </div>
  
  <div class="total">
    <table>
      <tr>
        <td>Subtotal:</td>
        <td>RM <?= number_format($subtotal, 2, '.', '') ?> </td>
      </tr>
      
     
  
   
      <?php if ($subtotal > 2000) {
                    $discount = ($subtotal * 0.05);
                ?>
                    <tr>
                        <td>Discount (5%)</td>
                        <td>(-) RM <?= number_format($discount, 2, '.', ''); ?> </td>
                    </tr>
                <?php } ?>
  
                <tr>
                    <?php
                    $tax = ($subtotal * 0.02);
                    ?>
                    <td>Service Tax (2%) </td>
                    <td>RM <?= number_format($tax, 2, '.', '') ?></td>
                </tr>     
                <?php             
               if(isset($resultss->ship_method) && $resultss->ship_method == "pick"){ 
                     $fee =1.60;
                     $totalpay += $fee;
               }else{
                   $fee = 4.60;
                     $totalpay += $fee;
                  }
                  ?>
              <tr>    
                 <td>Ship Fee (<?= $resultss->ship_method ?>) : </td>                 
                  <td>RM <?= number_format($fee, 2, '.', '') ?></td>
              </tr>


      <tr>
        <td><strong>Total Payment:</strong></td>
        <td><strong style="color:red">RM <?= number_format($totalpay = $subtotal - $discount + $tax + $fee, 2, '.', '') ?> </strong></td>
      </tr>
    </table>
  </div>


</div>
<a href="#" id="downloadBtn" class="download-btn" onclick="downloadAsPDF() ">Download PDF</a>
<a href="customer.php" id="downloadBtn" class="download-btn" >done</a>
</div>
<script>
    function downloadAsPDF() {
      const container = document.querySelector('.pdfGenerator');
      const options = {
        filename: 'receipt.pdf',
        margin: 20,
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
      };
      html2pdf().from(container).set(options).save();
    }
    
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  };
  </script>
  
</body>
</html>
