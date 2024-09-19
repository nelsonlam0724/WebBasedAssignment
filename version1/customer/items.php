<?php
include '../_base.php';
include '../include/header.php';
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
    
      <img id="images" src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" >
      <div class="btn-field-img">
      <button class="button_mul_img" data-select="left"><i class="fa fa-angle-double-left" style="font-size:36px"></i></button>
      <button class="button_mul_img" data-select="right"><i class="fa fa-angle-double-right" style="font-size:36px"></i></button>
      </div>
    <p id="demo" style="font-size: 20px;"></p>
    </div>
    <div class="box2">
      <div class="items-name">
        <h1><?= $product->name ?></h1>
      </div>
      <div class="item-description">
        <p><?= $product->description ?></p>
      </div>
      <div class="btn-field">
        <a href="#">
          <div class="btn-buy">Buy Now</div>
        </a>
        <div class="add-to-card add_card" data-add="<?= $product->product_id ?> ">Add to Cart</div>
      </div>
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
          $getCategory = $_db->prepare('SELECT * FROM category WHERE category_id = ?');
          $getCategory->execute([$c->category_id]);
          $category = $getCategory->fetch();
          ?>
          <div class="variation">Variation: <?= $category->category_name ?></div>
          <div class="comment-text"><?= $c->comment ?></div>
          <?php if ($c->photo != null) {  ?>
            <img src="../comment_img/<?= $c->photo ?>" alt="User Image" width="100" height="100">
          <?php }  ?>
          <div class="date"><?= $c->datetime ?></div>
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
const arr =<?php echo json_encode($imageProduct); ?>;
let i = 0;
const $image = $('#images');
const $demo = $('#demo');
const updateImage = () => {
  $image.prop('src', arr[i]);
  $demo.text('Image ' + (i + 1) + ' of ' + arr.length);
};
updateImage();
$('[data-select]').on('click', e => {
  const towards = e.target.getAttribute('data-select');
  i = (towards === 'left') ? (i === 0 ? arr.length - 1 : i - 1) : (i === arr.length - 1 ? 0 : i + 1);
  updateImage();
});
</script>
</body>


</html>