<?php
include '../_base.php';

$getProduct = $_db->query('SELECT * FROM product ');

include '../include/header.php';

?>
<link rel="stylesheet" href="../css/product.css">
<div class="items">
  <div class="line1">
    <p>763 product</p>
    <p style="cursor:pointer;background-color:yellow;padding:6px;">Filter <i class='bx bx-filter'></i></p>
  </div>

  <div class="items-lists">

    <?php foreach ($getProduct as $i): ?>
      <div class="items-card cards">
        <img src="<?= $i->product_photo ?>" width="100" height="200">
        <div class="text2">
          <p class="product-name space"> <?= $i->name ?></p>
          <p class="product-price space">RM <?= $i->price ?></p>
          <p class="product-stock space"><?= $i->name ?> Stock</p>
          <p class="product-sold space">22 sold</p>
        </div>
        <div class="button-select">
          <div class="wishlist" data-productid="<?= $i->product_id ?>">
            <p><i class="fa fa-heart"></i></p>
          </div>
          <div class="selection-button">
            <div class="add-to-card  add_card"  data-add="<?= $i->product_id ?>">
              <p><i class='bx bx-cart' style="font-size:24px" ></i>Add To Card</p>
            </div>
            <a href="#">
              <div class="view-product">
                <a href="items.php?id=<?= $i->product_id ?>">
                  <p style="color:white"><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </a>
              </div>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach ?>

  </div>
</div>
</body>
<script src="../js/product.js"></script>
<script></script>

</html>