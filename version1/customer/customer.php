<?php
include '../_base.php';
include '../_head.php';
auth('Member');
$_title = 'Customer Dashboard - ' . htmlspecialchars($_user->name);
include '../include/header.php';
include '../include/sidebar.php';

$getCategory = $_db->query('SELECT * FROM category');
$CategoryResults = $getCategory->fetchAll();

$topSalesData = $_db->query('
    SELECT p.name AS product_name, SUM(od.unit) AS total_units, p.price AS product_price, p.product_id AS product_id
    FROM orders AS o
    JOIN order_details AS od ON o.id = od.order_id
    JOIN product AS p ON od.product_id = p.product_id
    GROUP BY od.product_id
    ORDER BY total_units DESC
    LIMIT 10
')->fetchAll();
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

                    <?php foreach ($topSalesData as $top): ?>
                        <?php

                        $topProd = $_db->prepare('
                            SELECT product_photo FROM product_image
                            WHERE product_id = ?
                            LIMIT 1
                        ');
                        $topProd->execute([$top->product_id]);
                        $topPro = $topProd->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="product">
                            <?php if ($topPro && !empty($topPro->product_photo)): ?>
                                <img height="200" src="../uploads/<?= htmlspecialchars($topPro->product_photo) ?>" width="200" />
                            <?php else: ?>
                                <img height="200" src="../images/photo.jpg" width="200" />
                            <?php endif; ?>
                            <h3><?= htmlspecialchars($top->product_name) ?></h3>
                            <p class="price">RM<?= htmlspecialchars($top->product_price) ?></p>
                        </div>
                    <?php endforeach; ?>

                    <!-- Repeat the product div for other products -->
                </div>



            </div>
        </div>

        <div class="box1">
            <h1> Category</h1>
            <div class="grid">
                <?php foreach ($CategoryResults as $currentCategory): ?>
                    <a class="grid-item" href="../customer/product.php?category=<?= $currentCategory->category_id ?>">
                        <img alt="<?= htmlspecialchars($currentCategory->category_name) ?>" height="300" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmQs8xbIseku59onHMpZ6bQ3XaeaSjeLgzMQ&s" width="300" />
                        <div class="overlay"><?= htmlspecialchars($currentCategory->category_name) ?></div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php include '../_foot.php'; ?>


</body>

</html>