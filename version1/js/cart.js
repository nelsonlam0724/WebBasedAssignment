$(document).ready(function() {

    $('#bt').click(function() {
        $('.pop-up').removeClass('jump');
    });

    const checkboxes = $('input[name="selectItems[]"]');
    const quantityInputs = $('.qty');
    const subtotalElement = $('#subtotal');
    const taxElement = $('#tax');
    const totalElement = $('#total');
    const checkoutButton = $('#checkout-btn');
    const $checkboxesUnavailable = $('.check');

    function calculateTotalPrice() {
        let subtotal = 0;

        checkboxes.each(function(index) {
            if ($(this).is(':checked')) {
                const quantity = parseFloat($(quantityInputs[index]).val());
                const price = parseFloat($(quantityInputs[index]).data('price'));
                subtotal += quantity * price;
            }
        });

        const tax = subtotal * 0.02;
        const total = subtotal + tax;

        subtotalElement.text('RM ' + subtotal.toFixed(2));
        taxElement.text('RM ' + tax.toFixed(2));
        totalElement.text('RM ' + total.toFixed(2));

        checkoutButton.prop('disabled', subtotal === 0 || checkAvailability());
    }

    function checkAvailability() {
        let hasUnavailable = false;
        $checkboxesUnavailable.each(function() {
            if ($(this).is(':checked') && $(this).data('unavailable') === true) {
                hasUnavailable = true;
            }
        });
        return hasUnavailable;
    }

    checkboxes.change(function() {
        const isUnavailable = $(this).data('unavailable') === true;
        if (isUnavailable && $(this).is(':checked')) {
            $('.pop-up').addClass('jump');
            $('#message').text("This item is unavailable.");
            $(this).prop('checked', false); 
        }
        calculateTotalPrice(); 
    });

    quantityInputs.on('input', function() {
        const productId = $(this).data('product-id');
        const quantity = $(this).val();
        updateQuantity(productId, quantity); 
        calculateTotalPrice(); 
    });

    function updateQuantity(productId, qty) {
        let userID = $('.text-first h6').data('user');
        const input = $(`.qty[data-product-id="${productId}"]`);
        const stock = parseInt(input.data('stock'), 10); 
    
        if (qty > stock) {
            $('.pop-up').addClass('jump');
            $('#message').text("Quantity exceeds available stock.");
            input.val(input.data('previous-value'));  
            return;
        }
    
        $.ajax({
            url: '../function/update_cart.php',
            type: 'POST',
            data: {product_id: productId, quantity: qty, user: userID},
            success: function(response) {
                let res = JSON.parse(response);
                if (res.status === 'error') {
                    $('.pop-up').addClass('jump');
                    $('#message').text(res.message);
                    input.val(input.data('previous-value')); 
                } else {
                    input.data('previous-value', qty);
                    console.log('Quantity updated successfully:', response);
                }
            }
        });
    }
    
    
    function increaseValue(inputId) {
        const input = $('#' + inputId);
        let value = parseInt(input.val(), 10);
        const stock = parseInt(input.data('stock'), 10); // Get available stock
        if (isNaN(stock) || value >= stock) {
            $('.pop-up').addClass('jump');
            $('#message').text("Quantity exceeds available stock.");
            return;
        }
        value = isNaN(value) ? 1 : value + 1;
        input.val(Math.max(value, 1));
        const productId = input.data('product-id');
        updateQuantity(productId, value);  
        calculateTotalPrice();
    }
    
    function decreaseValue(inputId) {
        const input = $('#' + inputId);
        let value = parseInt(input.val(), 10);
        value = isNaN(value) ? 1 : value - 1;
        input.val(Math.max(value, 1));
        const productId = input.data('product-id');
        updateQuantity(productId, value);  
        calculateTotalPrice();
    }
    
    window.increaseValue = increaseValue;
    window.decreaseValue = decreaseValue;
});
