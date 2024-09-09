<?php 
include '../_base.php';
include '../include/header.php'; 

$id= req('id');

$getp = $_db->prepare('
SELECT * FROM `product` WHERE product_id = ?
');

$getp->execute([$id]);
$resultss = $getp->fetch();


if (is_post()) {

    $rating = req('rating');
    $photo = req('photo');
    $commentText = req('commentText');
   
  
    if (!$rating) {
      $_err['rating'] = '(you are require to rate!)**';
    }
  
    if (!$photo) {
      $_err['photo'] = '(Please Upload the photo!)**';
    }
  
    if (!$commentText) {
      $_err['commentText'] = '(Please fill up the comment!)**';
    }
  
    if (!$_err) {
  
        $stm = $_db->prepare('
        INSERT INTO `comment` (user_id,product_id,comment,rate,photo,datetime) VALUES ( ?, ?, ?, ?, ?, NOW())
        ');
    
        $stm->execute([$userID, $id, $commentText, $rating, $photo]);
    }

}








?>

<link rel="stylesheet" href="../css/comment.css">
</head>

<body>
    <div class="custRateContainer">
        <h1>Rate product</h1>
        <p>
            <div>
                <?= $resultss->name ?>             
        </div>
        <img src="../uploads/<?= $resultss->photo?>" height="100" width="100">
        </p>
        <form  method="post" id="rateForm">
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
                <p style="color:red;">  <?= err('rating') ?></p>
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
    </div>

  
    <script src="../js/comment.js"></script>
</body>

</html>
