
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


$(document).ready(function () {
    $('label.upload input[type=file]').on('change', e => {
        const f = e.target.files[0];
        const img = $(e.target).siblings('img')[0];

        if (!img) return;

        img.dataset.src ??= img.src;

        if (f?.type.startsWith('image/')) {
            img.src = URL.createObjectURL(f);
        } else {
            img.src = img.dataset.src;
            e.target.value = '';
        }
    });
    photo_value

});

