<?php include '../include/header.php'; ?>
<title>Itens</title>
<style>
    * {
        padding: 0;
        margin: 0;
        list-style-type: none;
        text-decoration: none;
        box-sizing: border-box;
    }

    .container {
        width: 100%;
        margin: 100px auto;
        padding: 50px;
        border-radius: 10px;
    }

    .cart-text {
        padding: 50px 0;
        text-align: center;

    }

    .cart-details {
        display: flex;
        justify-content: space-between;
    }

    .delete-cart {
        display: grid;
        place-items: center;
        padding: 20px;
        cursor: pointer;
    }

    .cart-list {
        width: 70%;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
    }

    .summary-price {
        width: 25%;
        background-color: white;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .cart-box {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }

    .product-info {
        display: flex;
        align-items: center;
    }

    .product-name {
        padding: 12px;
    }

    .btn-qty {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }

    .qty-btn {
        width: 25px;
        height: 25px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        line-height: 25px;
        text-align: center;
    }

    .qty-btn:hover {
        background-color: #eee;
    }

    .qty {
        width: 30px;
        height: 25px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        line-height: 25px;
        text-align: center;
        margin: 0 5px;
    }

    .qty-multiplier {
        font-size: 16px;
        font-weight: bold;
        margin-left: 5px;
    }

    .summary-price {
        position: relative;
        background-color: white;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        /* display: grid;
            place-items: center; */
    }

    .summary-price h4 {
        margin-top: 0;
    }

    .summary-price ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .summary-price li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .summary-price li:last-child {
        border-bottom: none;
    }

    .summary-price span:first-child {
        font-weight: bold;
        width: 100px;
        display: inline-block;
    }

    #checkout-btn {
        position: absolute;
        bottom: 10px;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 90%;
    }

    #checkout-btn:hover {
        background-color:#056edd;
    }


    .custom-checkbox {
        display: inline-block;
        position: relative;
        padding-left: 25px;
        cursor: pointer;
    }

    #check {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        appearance: none;
        background-color: white;
        border: 2px solid black;
        cursor: pointer;
    }


    #check:checked {
        background-color: #4CAF50;
        border: 2px solid white;
    }

    #check:checked::before {
        content: "✔";
        color: white;
        display: block;
        text-align: center;
        line-height: 30px;
    }

    .cart-box-list {
        overflow: hidden;
        height: 420px;
        overflow-y: scroll;

    }


    .cart-box-list::-webkit-scrollbar {
        width: 2px;
    }

    .cart-box-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .cart-box-list::-webkit-scrollbar-thumb {
        background-color: #007bff;
        border-radius: 10px;
        display: none;

    }

    .cart-box-list::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

     .cart-header{
        border-radius:15px 15px 3px 3px;
        display: flex;
        justify-content: space-around;
       flex-direction: left;
       padding: 7px;
       color: #fff;
       background-color:red;
     }
    @media (max-width: 768px) {
        .cart-details {
            flex-direction: column;
        }

        .cart-list {
            width: 100%;
            margin-bottom: 20px;
        }

        .summary-price {
            width: 100%;
        }
    }
</style>
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