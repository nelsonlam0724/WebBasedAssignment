<?php include '../include/header.php'; ?>
<title>Items</title>

<link rel="stylesheet" href="../css/cart.css">
</head>

<body>

    <div class="container">

        <div class="cart-text">
            <h2>Shopping Cart</h2>
        </div>

        <div class="cart-details">

            <div class="cart-list">

            <div class="cart-header">
                
               <h5>Product</h5>
               <h5>Quantity</h5>
               <h5>Subtotal</h5>
               <div></div>
            </div>
                <div class="cart-box-list">
                    <div class="cart-box">

                        <div class="product-info">
                            <div class="delete-cart">
                                <span style="font-size:25px">&times;</span>
                            </div>


                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSXUXld8NDEu716OSZ_8o7bvFgRi07Cs2ajw&s" width="90" height="90">

                            <div class="product-name">
                                <h4>The Pen</h4>
                            </div>
                        </div>

                        <div class="btn-qty">
                            <button class="qty-btn" onclick="decreaseValue('qtyInput<%= o %>')">-</button>
                            <input type="text" name="qty" class="qty" value="1" id="qtyInput<%= o %>" readonly>
                            <button class="qty-btn" onclick="increaseValue('qtyInput<%= o %>')">+</button>
                            <span class="qty-multiplier"></span>
                        </div>

                        <div style="display:grid;place-items:center;padding:5px;">
                            <h4>RM12.00</h4>
                        </div>

                        <div class="custom-checkbox">
                            <input id="check" type="checkbox" name="selectedRows" value="<%= row[0] %>" />

                        </div>

                    </div>


                    <div class="cart-box">

                        <div class="product-info">
                            <div class="delete-cart">
                                <span style="font-size:25px">&times;</span>
                            </div>


                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSXUXld8NDEu716OSZ_8o7bvFgRi07Cs2ajw&s" width="90" height="90">

                            <div class="product-name">
                                <h4>The Pen</h4>
                            </div>
                        </div>

                        <div class="btn-qty">
                            <button class="qty-btn" onclick="decreaseValue('qtyInput<%= 1 %>')">-</button>
                            <input type="text" name="qty" class="qty" value="1" id="qtyInput<%= 1 %>" readonly>
                            <button class="qty-btn" onclick="increaseValue('qtyInput<%= 1 %>')">+</button>
                            <span class="qty-multiplier"></span>
                        </div>

                        <div style="display:grid;place-items:center;padding:5px;">
                            <h4>RM12.00</h4>
                        </div>

                        <div class="custom-checkbox">
                            <input id="check" type="checkbox" name="selectedRows" value="<%= row[0] %>" />

                        </div>

                    </div>



                    <div class="cart-box">

                        <div class="product-info">
                            <div class="delete-cart">
                                <span style="font-size:25px">&times;</span>
                            </div>


                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSXUXld8NDEu716OSZ_8o7bvFgRi07Cs2ajw&s" width="90" height="90">

                            <div class="product-name">
                                <h4>The Pen</h4>
                            </div>
                        </div>

                        <div class="btn-qty">
                            <button class="qty-btn" onclick="decreaseValue('qtyInput<%= 2 %>')">-</button>
                            <input type="text" name="qty" class="qty" value="1" id="qtyInput<%= 2 %>" readonly>
                            <button class="qty-btn" onclick="increaseValue('qtyInput<%= 2 %>')">+</button>
                            <span class="qty-multiplier"></span>
                        </div>

                        <div style="display:grid;place-items:center;padding:5px;">
                            <h4>RM12.00</h4>
                        </div>

                        <div class="custom-checkbox">
                            <input id="check" type="checkbox" name="selectedRows" value="<%= row[0] %>" />

                        </div>

                    </div>



                    <div class="cart-box">

                        <div class="product-info">
                            <div class="delete-cart">
                                <span style="font-size:25px">&times;</span>
                            </div>


                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSSXUXld8NDEu716OSZ_8o7bvFgRi07Cs2ajw&s" width="90" height="90">

                            <div class="product-name">
                                <h4>The Pen</h4>
                            </div>
                        </div>

                        <div class="btn-qty">
                            <button class="qty-btn" onclick="decreaseValue('qtyInput<%= 3 %>')">-</button>
                            <input type="text" name="qty" class="qty" value="1" id="qtyInput<%= 3 %>" readonly>
                            <button class="qty-btn" onclick="increaseValue('qtyInput<%= 3 %>')">+</button>
                            <span class="qty-multiplier"></span>
                        </div>

                        <div style="display:grid;place-items:center;padding:5px;">
                            <h4>RM12.00</h4>
                        </div>

                        <div class="custom-checkbox">
                            <input id="check" type="checkbox" name="selectedRows" value="<%= row[0] %>" />

                        </div>

                    </div>

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
                <button id="checkout-btn">Checkout</button>
            </div>

        </div>

    </div>

</body>
<script>
    const checkboxes = document.querySelectorAll('input[name="selectedRows"]');
    const quantityInputs = document.querySelectorAll('.qty');


    function calculateTotalPrice() {
        let totalPrice = 0;
        checkboxes.forEach((checkbox, index) => {
            if (checkbox.checked) {
                const quantity = parseFloat(quantityInputs[index].value);
                const price = parseFloat(quantityInputs[index].parentNode.innerText.split('x')[1].trim());
                totalPrice += quantity * price;
            }
        });
        document.getElementById('demo').textContent = totalPrice.toFixed(2);
        submitButton.disabled = !atLeastOneChecked;
    }
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotalPrice);
    });

    quantityInputs.forEach(input => {
        input.addEventListener('input', calculateTotalPrice);
    });

    const checkbox = document.getElementById('check');
    const button = document.getElementById('unclick');

    button.disabled = true;

    function handleCheckboxChange() {
        let atLeastOneChecked = false;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                atLeastOneChecked = true;
            }
        });
        button.disabled = !atLeastOneChecked;
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    function increaseValue(inputId) {
        var value = parseInt(document.getElementById(inputId).value, 10);
        value = isNaN(value) ? 1 : value;
        value++;
        document.getElementById(inputId).value = Math.max(value, 1);
    }

    function decreaseValue(inputId) {
        var value = parseInt(document.getElementById(inputId).value, 10);
        value = isNaN(value) ? 1 : value;
        value--;
        document.getElementById(inputId).value = Math.max(value, 1);
    }

    function back() {

        window.history.back();
    }

    function goBack(page) {
        window.location.href = page;
    }
</script>

</html>