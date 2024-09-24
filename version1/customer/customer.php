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
            <div class="slider1k">
                <div class="slide">
                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">

                    <div class="st first">
                        <img src="https://th.bing.com/th/id/OIP.PGaJe6UCG-Ua1RSEO1hD4gHaEK?w=350&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="">
                    </div>

                    <div class="st">
                        <img src="https://th.bing.com/th?id=OIP.GZ97afCRQa5vBgEHqDobtQHaFS&w=295&h=211&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" alt="">
                    </div>

                    <div class="st">
                        <img src="https://th.bing.com/th/id/OIP.EWOHATWuDf1VIVV96ViEegHaFD?w=256&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="">
                    </div>

                    <div class="st">
                        <img src="https://www.unimastershipping.com/store/2018/03/stationary-1110x550.png" alt="">
                    </div>

                    <div class="nav-auto">
                        <div class="a-b1"></div>
                        <div class="a-b2"></div>
                        <div class="a-b3"></div>
                        <div class="a-b4"></div>
                    </div>
                </div>

                <div class="nav-m">
                    <label for="radio1" class="m-btn"></label>
                    <label for="radio2" class="m-btn"></label>
                    <label for="radio3" class="m-btn"></label>
                    <label for="radio4" class="m-btn"></label>
                </div>

            </div>

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


                            <div class="popup">
                                <a href="items.php?id=<?= $top->product_id  ?>"><button class="like-button">view</button></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>




            </div>
        </div>

        <hr>

        <div class="about-us">
            <div class="about-container">
                <div class="about-image">
                    <img src="../images/。.jpg" alt="About Us Image">
                </div>
                <div class="about-desc">
                    <h2>About Us</h2>
                    <p>
                        Qianho Stationary is dedicated to providing a wide range of office supplies, ensuring quality and affordability.
                        With years of experience in the industry, we are a trusted source for all your stationery needs.
                        Our mission is to deliver the best products to meet the needs of businesses, schools, and individuals.
                        Whether you're looking for pens, paper, or specialized equipment, Qianho Stationary has it all.
                    </p>
                </div>
            </div>
        </div>

        <hr>

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
<script>
    $(window).on('load', function() {
        var scrollPos = localStorage.getItem('scrollPos') || 0;
        $(window).scrollTop(scrollPos);
    });

    var counter = 1;
    setInterval(function() {
        $('#radio' + counter).prop('checked', true);
        counter++;
        if (counter > 4) {
            counter = 1;
        }
    }, 5000);
</script>

</html>