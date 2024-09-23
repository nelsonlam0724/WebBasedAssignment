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
            $(this).prop('checked', false); 
        }
        calculateTotalPrice(); 
    });

    quantityInputs.on('input', calculateTotalPrice);

    function increaseValue(inputId) {
        const input = $('#' + inputId);
        let value = parseInt(input.val(), 10);
        value = isNaN(value) ? 1 : value + 1;
        input.val(Math.max(value, 1));
        calculateTotalPrice();
    }

    function decreaseValue(inputId) {
        const input = $('#' + inputId);
        let value = parseInt(input.val(), 10);
        value = isNaN(value) ? 1 : value - 1;
        input.val(Math.max(value, 1));
        calculateTotalPrice();
    }

    window.increaseValue = increaseValue;
    window.decreaseValue = decreaseValue;
});
