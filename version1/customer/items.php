<?php
include '../_base.php';
include '../include/header.php';
$product_id = get('id');
$getProduct = $_db->prepare('SELECT * FROM product WHERE product_id = ?');
$getProduct->execute([$product_id]);
$product = $getProduct->fetch(PDO::FETCH_OBJ);
?>

<title>Item Details</title>
<link rel="stylesheet" href="../css/items.css">

<div class="container">
  <div class="item-board">
    <div class="items-card">
      <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" alt="Product Image">
    </div>
    <div class="box2">
      <div class="items-name">
        <h1><?= $product->name ?></h1>
      </div>
      <div class="item-description">
        <p><?= $product->description ?></p>
      </div>
      <div class="btn-field">
        <a href="#"><div class="btn-buy">Buy Now</div></a>
        <div class="add-to-card" data-items="<?= $product->product_id ?>">Add to Cart</div>
      </div>
    </div>
  </div>
  <div class="review-field">
    <h3>Reviews</h3>
    <div class="comment-box">
      <div class="user-review">
        <div class="user-name">Kimho</div>
        <div class="star-rating">
          <p style="font-size:20px;color:yellowgreen">★★★★★</p>
          <p><i class='bx bx-like'></i> 0</p>
        </div>
      </div>
      <div class="review-content">
        <div class="variation">Variation: keyboard</div>
        <div class="comment-text">Item received in good condition, packed well, hopefully the quality is good, thank you</div>
        <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" alt="User Image" width="100" height="100">
        <div class="date">12-05-2024</div>
      </div>
    </div>
    <div class="comment-box">
      <div class="user-review">
        <div class="user-name">Kimho</div>
        <div class="star-rating">
          <p style="font-size:20px;color:yellowgreen">★★★★★</p>
          <p><i class='bx bx-like'></i> 0</p>
        </div>
      </div>
      <div class="review-content">
        <div class="comment-text">Item received in good condition, packed well, hopefully the quality is good, thank you</div>
        <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" alt="User Image" width="100" height="100">
        <div class="date">12-05-2024</div>
      </div>
    </div>
  </div>
</div>

<script src="../js/product.js"></script>
</body>
</html>