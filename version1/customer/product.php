<?php
include '../_base.php';
require_once '../lib/SimplePager.php';
include '../include/header.php';

$search = req('search');
$category = req('category_id');
$p =  [];
$getProduct = [];
$page = req('page', 1);

if (!empty($search) && !empty($category)) {
  $sql_product = 'SELECT * FROM  product WHERE  name LIKE ? AND category_id = ? ';
  $p = new SimplePager($sql_product, ['%' . $search . '%', $category], 10, $page);
  $getProduct = $p->result;
} else if (empty($search) && !empty($category)) {
    $sql_product = 'SELECT * FROM  product WHERE category_id = ? ';
    $p = new SimplePager($sql_product, [$category], 10, $page);
    $getProduct = $p->result;
} else {
    $p = new SimplePager('SELECT * FROM product WHERE name LIKE ?', ['%' . $search . '%'], 10, $page);
    $getProduct = $p->result;
}

$getCategory = $_db->query('
    SELECT * FROM category 
');
$CategoryResults = $getCategory->fetchAll();
?>



<link rel="stylesheet" href="../css/product.css">

<div class="items">
  <div class="line1">
    <p><?= $p->item_count ?> product</p>
    <p>
      <?= $p->count ?> of <?= $p->item_count ?> product(s)
    </p>
    <div class="filter-container">
      <p class="filter-button">
        Filter <i class='bx bx-filter'></i>
      </p>
      <ul class="filter-list">
      <a href="../customer/product.php"><li>ALL</li></a>
        <?php foreach ($CategoryResults as $category): ?>
        <a href="../customer/product.php?search=<?= $search ?>&category_id=<?= $category->category_id?>">
          <li><?= $category->category_name ?></li>
        </a>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
  <?php if ($p->item_count == 0) { ?>
    <div style="padding:30px;">
      <h2>No results for " <?= $search  ?> "</h2>
    </div>
  <?php } ?>
  <div class="items-lists">

    <?php
    if ($p->item_count != 0) {
      foreach ($getProduct as $i): ?>
        <div class="items-card cards">
          <img src="../uploads/<?= $i->product_photo ?>" width="100" height="200">
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
              <div class="add-to-card  add_card" data-add="<?= $i->product_id ?>">
                <p><i class='bx bx-cart' style="font-size:24px"></i>Add To Card</p>
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
    <?php endforeach;
    } ?>
  </div>
  <div style="padding:30px;display:grid;place-items:center;">

    <?php if ($p->item_count != 0) { ?>
      <p style="padding:50px;">
        <?= $p->page ?> / <?= $p->page_count ?>
      </p>
    <?php } else {
      echo '<img  src="../images/search.png"  width="100" height="100" >';
    ?>
    <?php } ?>

    <?= $p->html() ?>
  </div>
</div>
</body>
<script src="../js/product.js"></script>
<script></script>

</html>