<?php
include '../_base.php';
auth('Member');
$_title = 'Customer Dashboard - ' . htmlspecialchars($_user->name);
include '../include/header.php';
include '../include/sidebar.php';

$getCategory = $_db->query('SELECT * FROM category');
$CategoryResults = $getCategory->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Page</title>
    <link rel="stylesheet" href="../css/customer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>做slidebar要吗？</h1>
        </div>

        <div class="best-sellers">
            <h2> Best Sellers</h2>
            <div class="products-container">
       

                    <div class="products">
                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>

                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>


                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>


                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>



                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>


                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>


                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>


                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>


                        <div class="product">
                            <img height="200" src="https://media.istockphoto.com/id/173015527/photo/a-single-red-book-on-a-white-surface.jpg?s=612x612&w=0&k=20&c=AeKmdZvg2_bRY2Yct7odWhZXav8CgDtLMc_5_pjSItY=" width="200" />
                            <h3>Book</h3>
                            <p class="price">RM 9.95</p>
                        </div>
                        <!-- Repeat the product div for other products -->
                    </div>
           

               
            </div>
        </div>

        <div class="box1">
            <h1> Category</h1>
            <div class="grid">
                <?php foreach ($CategoryResults as $currentCategory): ?>
                    <a class="grid-item" href="../customer/product.php?category=<?= $currentCategory->category_id ?>">
                        <img alt="<?= htmlspecialchars($currentCategory->category_name) ?>" height="300" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmQs8xbIseku59onHMpZ6bQ3XaeaSjeLgzMQ&s" width="300"/>
                        <div class="overlay"><?= htmlspecialchars($currentCategory->category_name) ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include '../_foot.php'; ?>

   
</body>
</html>
