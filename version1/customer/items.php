<?php
include '../_base.php';
include '../include/header.php';
$product_id = get('id');
$getProduct = $_db->prepare('SELECT * FROM product WHERE product_id = ?');
$getProduct->execute([$product_id]);
$product = $getProduct->fetch(PDO::FETCH_OBJ);


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
<style>
  .items-card {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position:relative;
}

.button_mul_img {
    background-color: white;
    color: black;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    margin: 10px;
    border:2px solid black;
}

.btn-field-img{
   display: flex;
   width: 100%;
   justify-content: space-between;
   position: absolute;
   top:45%;
}




#demo {
    margin-top: 10px;
    font-weight: bold;
}



#images{
  width:500px;
  height:500px;
}

</style>

<div class="container">
  <div class="item-board">
    <div class="items-card">
    
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
        <div class="add-to-card" data-items="<?= $product->product_id ?>">Add to Cart</div>
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

const arr = ['https://cdn.zbaseglobal.com/saasbox/resources/webp/ai-anime-character-maker5-fotor-20230818142110__4047b2d6dedbdb910257fca8eb808dca.webp', 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/12532de5-e93d-4cd5-9bbe-cace0d45f7a9/dfkmgsu-b74af07f-b32d-421a-8f83-128888c3de10.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzEyNTMyZGU1LWU5M2QtNGNkNS05YmJlLWNhY2UwZDQ1ZjdhOVwvZGZrbWdzdS1iNzRhZjA3Zi1iMzJkLTQyMWEtOGY4My0xMjg4ODhjM2RlMTAucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.qFaI6FaJVlQVxEutx_3Njb3vspI_lNc7ttINRPsf-TU','https://assets-global.website-files.com/632ac1a36830f75c7e5b16f0/64f116759667a1fbf0c59c60_fOqQSv2iutbUbwh3tXUdPBe4m_mX5ChHOYvM7taH_SE.webp','https://www.gemoo-resource.com/tools/img/ai_image_anime_7@2x.png','https://static.vecteezy.com/system/resources/previews/030/798/293/large_2x/ai-generative-warrior-anime-girl-in-pink-and-anime-style-free-photo.jpg'];
let i = 0;
$('#images').prop('src', arr[i]);
$('#demo').text('Image 1 of ' + arr.length);
$('[data-select]').on('click', e => {
    const towards = e.target.getAttribute('data-select');
    if (towards === "left") {
        i = (i == 0) ? arr.length - 1 : i - 1;
    } else if (towards === "right") {
        i = (i == arr.length - 1) ? 0 : i + 1;
    }
    $('#images').prop('src', arr[i]);
    $('#demo').text('Image '+ (i+1)+' of '+ arr.length);
});

</script>
</body>


</html>