
$(document).ready(function() {
    $('input[name="rating"]').on('click', function() {
        var value = $(this).val();
        var ratingText = "";

        switch (value) {
            case '1':
                ratingText = "Poor";
                break;
            case '2':
                ratingText = "Fair";
                break;
            case '3':
                ratingText = "Average";
                break;
            case '4':
                ratingText = "Good";
                break;
            case '5':
                ratingText = "Excellent";
                break;
            default:
                ratingText = "";
                break;
        }

        $('#ratingText').text(ratingText);
    });


});
