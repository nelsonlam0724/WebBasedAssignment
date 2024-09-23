<?php


include '../_base.php';
include '../include/header.php';
include '../include/sidebar.php';

auth('Member');

$information = $_db->prepare('SELECT p.* ,f.* 
                             FROM favorite AS f 
                             JOIN product AS p ON f.product_id = p.product_id
                             WHERE f.user_id = ? AND p.status= ?');
$information->execute([$userID,"Available"]);
$informations = $information->fetchAll(PDO::FETCH_ASSOC);

?>
<title>QianHo Wishlist</title>

<link rel="stylesheet" href="../css/wishList.css">
</head>

<body>

  <div class="contents">
    <div class="breadcrumb">
      Wishlist
    </div>
    <table class="wishlist-table">
      <thead>
        <tr>
          <th> Product Details</th>
          <th>Price</th>
          <th>View</th>
          <th>Remove</th>
        </tr>
      </thead>
      <?php
      $countFavRecord = $_db->prepare('SELECT COUNT(*) AS total_records FROM favorite WHERE user_id = ? ');
      $countFavRecord->execute([$_SESSION['user']->user_id]);
      $resul = $countFavRecord->fetch();

      ?>
      <p>(<?= $resul->total_records  ?>) Records</p>
      <tbody>

        <?php foreach ($informations as $w):



          $getProductImg = $_db->prepare('SELECT product_photo FROM product_image WHERE product_id = ?');
          $getProductImg->execute([$w['product_id']]);
          $productImg = $getProductImg->fetch(PDO::FETCH_OBJ);
          $productPhoto = $productImg ? $productImg->product_photo : '../images/photo.jpg';
        ?>


          <tr>
            <td>
              <img height="100" src="../uploads/<?= $productPhoto ?>" width="100" />
              <?= $w['name'] ?>
            </td>
            <td>RM <?= $w['price'] ?></td>
            <td><a href="items.php?id=<?= $w['product_id']  ?>"><button class="btn btn-view">View</button></a>
            </td>
            <td>
              <button class="btn btn-remove" data-del="<?= $w['product_id'] ?>">Remove</button>
            </td>
          </tr>

        <?php endforeach  ?>
      </tbody>
    </table>
  </div>
  <script src="../js/product.js"></script>
</body>

</html>