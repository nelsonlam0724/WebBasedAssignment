<?php 
include '../_base.php';
include '../include/header.php'; 


$getUserID = $_db->prepare('
    SELECT c.id, c.unit, p.name, p.product_photo, p.price, p.product_id  
    FROM carts AS c
    JOIN product AS p ON c.product_id = p.product_id 
    WHERE c.user_id = ? 
');

$getUserID->execute([$userID]);
$results = $getUserID->fetchAll(PDO::FETCH_ASSOC);
$cart = [];
foreach ($results as $c) {
    $cart[$c['product_id']] = $c['unit'];
}

if(is_post()) {
    $totalItems = post('product');
    $items = post('selectItems');
    $unit = post('qty');
    $cartSelected = [];

    for ($i = 0; $i < count($totalItems); $i++) {
        if (isset($totalItems[$i]) && isset($unit[$i])) {
            $cart[$totalItems[$i]] = $unit[$i];
        }
    }
    
    for($i =0; $i < count($items); $i++) {
        if(isset($cart[$items[$i]])) {           
            $cartSelected[$items[$i]] = $cart[$items[$i]];
        }
    }

    $_SESSION['cartSelection'] = $cartSelected;
    header('Location: checkout.php');
    exit();
}

?>
<title>Items</title>

<link rel="stylesheet" href="../css/cart.css">
</head>

<body>

<div class="container">

    <div class="cart-text">
        <h2>Shopping Cart</h2>
    </div>

    <form method="post">
        <div class="cart-details">

            <div class="cart-list">

                <div class="cart-header">
                    <h5>Product</h5>
                    <h5>Quantity</h5>
                    <h5>Price</h5>
                    <div></div>
                </div>

                <div class="cart-box-list">
                    <?php 
                    $count = 0;
                    foreach ($results as $c): ?>
                    <div class="cart-box">
                       <input type="hidden" name="product[]" value="<?=$c['product_id']?>">
                        <div class="product-info">
                            <div class="delete-cart">
                                <span style="font-size:25px" class="delete" data-del="<?=$c['id']?>">&times;</span>
                            </div>

                            <img src="<?=$c['product_photo']?>" width="90" height="90">

                            <div class="product-name" style="width:20px;">
                                <h4 ><?= $c['name'] ?></h4>
                            </div>
                        </div>

                        <div class="btn-qty">
                            <div class="qty-btn" onclick="decreaseValue('<?= $count ?>')">-</div>
                            <input type="text" name="qty[]" class="qty" value="<?= $c['unit'] ?>" id="<?=$count?>" readonly data-price="<?=$c['price']?>">
                            <div class="qty-btn" onclick="increaseValue('<?= $count ?>')">+</div>
                        </div>

                        <div style="display:grid;place-items:center;padding:5px;">
                            <h4>RM<?= $c['price'] ?></h4>
                        </div>

                        <div class="custom-checkbox">
                            <input id="check_<?=$c['product_id']?>" class="check" type="checkbox" name="selectItems[]" value="<?=$c['product_id']?>" />
                        </div>

                    </div>
                    <?php 
                    $count++;
                    endforeach ?>

                    <?php if($count == 0): ?>
                        <p style="padding:50px;font-size:30px;">Your Cart Is Empty</p>
                    <?php endif; ?>
                </div>

            </div>

            <div class="summary-price">
                <h4>Summary</h4>
                <div style="padding:20px 0px 40px 0px;">
                    <ul>
                        <li>
                            <span>Subtotal:</span>
                            <span id="subtotal">RM 0.00</span>
                        </li>
                        <li>
                            <span>Tax (5%):</span>
                            <span id="tax">RM 0.00</span>
                        </li>
                        <li>
                            <span>Total:</span>
                            <span id="total">RM 0.00</span>
                        </li>
                    </ul>
                </div>
                <button id="checkout-btn" disabled>Checkout</button>
            </div>

        </div>
    </form>

</div>

</body>

<script src="../js/product.js"></script>
<script src="../js/cart.js"></script>

</html>
