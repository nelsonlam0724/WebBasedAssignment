<?php 
include '../_base.php';
include '../include/header.php'; 

// Fetch the cart items for the logged-in user
$getUserID = $_db->prepare('
    SELECT c.id, c.unit, p.name, p.product_photo, p.price, p.product_id  
    FROM carts AS c
    JOIN product AS p ON c.product_id = p.product_id 
    WHERE c.user_id = ? 
');
$getUserID->execute([$userID]);

// Fetch all results
$results = $getUserID->fetchAll(PDO::FETCH_ASSOC);

// Initialize cart
$cart = [];
foreach ($results as $c) {
    $cart[$c['product_id']] = $c['unit'];
}

if(is_post()) {
    $items = post('selectItems');
    $unit = post('qty');
    $cartSelected = [];

    // Loop through the cart items and find the selected ones
    for($i = 0; $i < count($items); $i++) {
        if(isset($cart[$items[$i]])) {
            $cartSelected[$items[$i]] = $unit[$i];
        }
    }

    // Save selected items in session and redirect to payment page
    $_SESSION['cartSelection'] = $cartSelected;
    header('Location: payment.php');
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
                    <h5>Subtotal</h5>
                    <div></div>
                </div>

                <div class="cart-box-list">
                    <?php 
                    $count = 0;
                    foreach ($results as $c): ?>
                    <div class="cart-box">

                        <div class="product-info">
                            <div class="delete-cart">
                                <span style="font-size:25px" class="delete" data-del="<?=$c['id']?>">&times;</span>
                            </div>

                            <img src="<?=$c['product_photo']?>" width="90" height="90">

                            <div class="product-name">
                                <h4><?= $c['name'] ?></h4>
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
                            <span>Tax (10%):</span>
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
<script>
    const checkboxes = document.querySelectorAll('input[name="selectItems[]"]');
    const quantityInputs = document.querySelectorAll('.qty');
    const subtotalElement = document.getElementById('subtotal');
    const taxElement = document.getElementById('tax');
    const totalElement = document.getElementById('total');
    const checkoutButton = document.getElementById('checkout-btn');

    function calculateTotalPrice() {
        let subtotal = 0;

        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const quantity = parseFloat(quantityInputs[index].value);
                const price = parseFloat(quantityInputs[index].getAttribute('data-price'));
                subtotal += quantity * price;
            }
        });

        const tax = subtotal * 0.10;
        const total = subtotal + tax;

        subtotalElement.textContent = 'RM ' + subtotal.toFixed(2);
        taxElement.textContent = 'RM ' + tax.toFixed(2);
        totalElement.textContent = 'RM ' + total.toFixed(2);

        // Enable checkout button if at least one item is selected
        checkoutButton.disabled = subtotal === 0;
    }

    // Add event listeners to checkboxes and quantity inputs
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotalPrice);
    });

    quantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotalPrice);
    });

    function increaseValue(inputId) {
        const input = document.getElementById(inputId);
        let value = parseInt(input.value, 10);
        value = isNaN(value) ? 1 : value + 1;
        input.value = Math.max(value, 1);
        calculateTotalPrice();
    }

    function decreaseValue(inputId) {
        const input = document.getElementById(inputId);
        let value = parseInt(input.value, 10);
        value = isNaN(value) ? 1 : value - 1;
        input.value = Math.max(value, 1);
        calculateTotalPrice();
    }
</script>

</html>
