<?php
include '../_base.php';
include '../include/header.php';
include '../include/sidebar.php';
auth('Member');
$product_id = get('id');
$getProduct = $_db->prepare('SELECT * FROM product WHERE product_id = ?');
$getProduct->execute([$product_id]);
$product = $getProduct->fetch(PDO::FETCH_OBJ);


$getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
$getProductImg->execute([$product_id]);

$productImgs = $getProductImg->fetchAll(PDO::FETCH_OBJ);

$imageProduct = [];
foreach ($productImgs as $productImg) {
  $imageProduct[] = $productImg->product_photo;
}

$getComment = $_db->prepare('
    SELECT c.* ,u.name AS user_name , p.name AS product_name , p.category_id
    FROM comment AS c 
    JOIN product AS p ON c.product_id = p.product_id
    JOIN user AS u ON c.user_id = u.user_id
    WHERE c.product_id = ?
');
$getComment->execute([$product_id]);
$comment = $getComment->fetchAll();

?>

<title>Item Details</title>
<link rel="stylesheet" href="../css/items.css">


<div class="container">
  <div class="item-board  cards">
    <div class="items-cards">

      <img id="images" src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2">
      <div class="btn-field-img">
        <button class="button_mul_img" data-select="left"><i class="fa fa-angle-double-left" style="font-size:36px"></i></button>
        <button class="button_mul_img" data-select="right"><i class="fa fa-angle-double-right" style="font-size:36px"></i></button>
      </div>
      <p id="demo" style="font-size: 20px;"></p>
    </div>


    <div class="box2">


      <div class="product-title"><?= $product->name ?></div>

      <div class="product-description">
        <?= $product->description ?>
      </div>


      <div class="price">RM <?= $product->price ?></div>
      <button class="add-to-card add_card" data-add="<?= $product->product_id ?>">ADD TO CART</button>
    </div>



  </div>
  <div class="review-field">
    <h3>Reviews</h3>


    <?php $count = 0;
    foreach ($comment as $c): ?>
      <div class="comment-box">
        <div class="user-review">
          <div class="user-name" style="color:black;font-size:15px"><?= $c->user_name ?></div>
          <div class="star-rating">
            <input type="hidden" name="rate" value="<?= $c->rate ?>" class="rate">
            <p style="font-size:20px;color:yellowgreen;display:flex;" class="star-rating-display"></p>
          </div>
        </div>
        <div class="review-content">
          <?php
          // Fetch category information
          $getCategory = $_db->prepare('SELECT * FROM category WHERE category_id = ?');
          $getCategory->execute([$c->category_id]);
          $category = $getCategory->fetch();
          ?>
          <div class="variation">Variation: <?= htmlspecialchars($category->category_name) ?></div>
          <div class="comment-text"><?= htmlspecialchars($c->comment) ?></div>
          <?php if ($c->photo != null) {  ?>
            <img src="../comment_img/<?= htmlspecialchars($c->photo) ?>" alt="User Image" width="100" height="100">
          <?php }  ?>
          <div class="date"><?= htmlspecialchars($c->datetime) ?></div>

          <?php if (!empty($c->reply)) { ?>
            <div class="admin-reply">
              <span class="reply-header">Admin Reply:</span>
              <strong>
                <div class="reply-content"><?= htmlspecialchars($c->reply) ?></div>
              </strong>
            </div>
          <?php } ?>
        </div>

      </div>
    <?php $count++;
    endforeach;


    if ($count == 0) {
      echo "<p style='padding:30px;'>Record Not Found</p>";
    }
    ?>


  </div>
</div>

<script src="../js/product.js"></script>
<script>
  const arr = <?php echo json_encode($imageProduct); ?>;
</script>
<script src="../js/updateImage.js"></script>
</body>


</html>