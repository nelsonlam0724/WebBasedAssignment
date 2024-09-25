<?php 
include '../_base.php';
auth('Member');
$id= req('id');
$ordedsID = req('order_id');

$getp = $_db->prepare('
SELECT * FROM `product` WHERE product_id = ?
');

$getp->execute([$id]);
$resultss = $getp->fetch();


if (is_post()) {

    $rating = req('rating');
    $photo = $_FILES['photo'];  
    $commentText = req('commentText');
    $uploadDir = '../comment_img/';  

    if (!$rating) {
        $_err['rating'] = '(You are required to rate!)**';
    }

    
    if (!$photo['name']) {
        $_err['photo'] = '(Please upload the photo!)**';
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($photo['type'], $allowedTypes)) {
            $_err['photo'] = '(Invalid file type! Only JPG, PNG, and GIF are allowed.)**';
        }
        if (!$_err['photo']) {
            $photoName = basename($photo['name']);
            $photoPath = $uploadDir . $photoName;

            if (!move_uploaded_file($photo['tmp_name'], $photoPath)) {
                $_err['photo'] = '(Error uploading file! Please try again.)**';
            }
        }
    }


    if (!$commentText) {
        $_err['commentText'] = '(Please fill up the comment!)**';
    }

    if (!$_err) {
        $commentid = generateID('comment', 'comment_id', 'CM', 4);
        $stm = $_db->prepare('
        INSERT INTO `comment` (comment_id ,user_id, product_id, comment, rate, photo, datetime) 
        VALUES (?,?, ?, ?, ?, ?, NOW())
        ');

        $stm->execute([$commentid,$_SESSION['user']->user_id, $id, $commentText, $rating, $photoName]);

        $updateStatus = $_db->prepare('
        UPDATE `order_details` SET comment_status = ? WHERE product_id = ? AND order_id = ?
        ');

        $updateStatus->execute(["Rated",$id,$ordedsID]);
        redirect('customer.php');
        temp('info','Thanks for your comment');
    }
}
?>
<style>

</style>
<link rel="stylesheet" href="../css/comment.css">
<title>Comment</title>
</head>

<body>
    <?php 
    include '../include/header.php'; 
    include '../include/sidebar.php';
      ?>
    <div class="custRateContainer">
        <h1 style="padding:20px;">Rate product</h1>
        <p style="display: flex;gap:20px">
            <?php   
            
            $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
            $getProductImg->execute([$resultss->product_id]);
            $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
            $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';
            
            
            ?>
            <img src="../uploads/<?= $productPhoto ?>" height="100" width="100">
           
            <span style="color:black;"> <?= $resultss->name ?></br>RM <?= $resultss->price ?></span> </br>
        </p>
        <form method="post" id="rateForm" enctype="multipart/form-data">
            <div class="productQuality">
                <p><br><br><br><br><br>Please Rate :</p>
                <div class="rating">
                    <input type="radio" name="rating" id="rate1" value="5">
                    <label for="rate1"></label>
                    <input type="radio" name="rating" id="rate2" value="4">
                    <label for="rate2"></label>
                    <input type="radio" name="rating" id="rate3" value="3">
                    <label for="rate3"></label>
                    <input type="radio" name="rating" id="rate4" value="2">
                    <label for="rate4"></label>
                    <input type="radio" name="rating" id="rate5" value="1">
                    <label for="rate5"></label>
                    <br>
                </div>
                <p id="ratingText"></p>
                <p style="color:red;"><?= err('rating') ?></p>
            </div>
            <br><br>
            <label for="photo">Product Photo:</label><br>
            <p style="color:red;"><?= err('photo') ?></p>
            <label class="upload" tabindex="0">
                <?= html_file('photo', 'image/*', 'hidden') ?>
                <img src="../images/photo.jpg" width="100" height="100">
            </label>
            <br>
            <div class="inputBox">
                <br>
                <p style="color:red;"><?= err('commentText') ?></p>
                <textarea name="commentText" id="commentText" placeholder="Enter your comment here"></textarea>
                <div class="submitContainer">
                    <input type="reset" name="reset" value="Reset" id="reset">
                    <input type="submit" name="submit" value="Submit" id="submit">
                </div>
            </div>
        </form>
    </div>
  
    <script src="../js/comment.js"></script>
</body>

</html>
