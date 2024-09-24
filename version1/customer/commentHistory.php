<?php
include '../_base.php';
include '../include/header.php';
auth('Member');



$getComment = $_db->prepare('
    SELECT c.* ,u.name AS user_name , p.name AS product_name , p.category_id
    FROM comment AS c 
    JOIN product AS p ON c.product_id = p.product_id
    JOIN user AS u ON c.user_id = u.user_id
    WHERE c.user_id = ?
');
$getComment->execute([$_SESSION['user']->user_id]);
$comment = $getComment->fetchAll();
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/commentHis.css">
</head>

<body>
    <div class="cons">
        <div style="padding:20px;background-color:black;color:white;">Comment History</div>
        <?php
        $count=0;
        include '../include/sidebar.php';
        foreach ($comment as $c):

            $img = ($_SESSION['user']->photo != null) ? "../uploads/" . $_SESSION['user']->photo : "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png";

            $getCategory = $_db->prepare('SELECT * FROM category WHERE category_id = ?');
            $getCategory->execute([$c->category_id]);
            $category = $getCategory->fetch(); ?>

            <div class="review-container">
                <div class="user-info">
                    <img src="<?= $img ?>" height="100" src="" width="100" />
                    <span><?= $c->user_name ?></span>
                </div>
                <div class="star-rating">
                    <input type="hidden" name="rate" value="<?= $c->rate ?>" class="rate">
                    <p style="font-size:20px;color:yellowgreen;display:flex;" class="star-rating-display"></p>
                </div>
                <div class="review-details"><?= $c->datetime ?> | Variation: <?= $category->category_name ?></div>
                <img height="60" src="../comment_img/<?= $c->photo  ?>" width="60" />

                <div class="review-text">
                    <?php
                    $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
                    $getProductImg->execute([$c->product_id]);
                    $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
                    $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';

                    ?>
                    <p><?= $c->comment ?></p>
                </div>

                <?php if (!empty($c->reply)) { ?>
                    <div class="admin-reply">
                        <span class="reply-header">Admin Reply:</span>
                        <strong>
                            <div class="reply-content"><?= htmlspecialchars($c->reply) ?></div>
                        </strong>
                    </div>
                <?php } ?>

                <div class="product">
                    <img height="60" src="../uploads/<?= $productPhoto  ?>" width="60" />
                    <span><?= $c->product_name  ?></span>
                </div>


            </div>
            <br>
        <?php $count++;endforeach ;
            if($count==0){
                echo "<h3>Record Not Found</h3>";
            }
        ?>
         
    </div>
</body>
<script src="../js/product.js"></script>

</html>