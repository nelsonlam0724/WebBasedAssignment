$(document).ready(function(){
    $('.wishlist').on("click",function(){
  
        let $this = $(this);  
        let userID = parseInt( $('.text-first h6').data('user'));
        let productID = parseInt($this.data('productid'));             
        $.ajax({
            url: '../function/add_favorite.php',
            type: 'POST',
            data: {user: userID, product: productID},
            success: function(response) {
                let checkClick = JSON.parse(response);      
                if(checkClick > 0){
                    $this.find('p i').css("color", "red");
                }else{
                    $this.find('p i').css("color", "transparent");
                }
            }
        });
    });
   
    fetchWishList();
    function fetchWishList() {
        let userID = parseInt($('.text-first h6').data('user'));
        $('.wishlist').each(function() {
            let $this = $(this);  
            let productID = parseInt($this.data('productid'));
            $.ajax({
                url: '../function/fetch_wishlist.php',
                type: 'POST',
                data: {user: userID},
                success: function(response) {
                    var records = JSON.parse(response);
                    records.forEach(function(record) {
                        if ( parseInt(record.product_id) ==  productID) {
                            $this.find('p i').css("color", "red");
                        }
                    });
                }
            });
        });
    }
    
    $('.add_card').on("click", function() {     
        let $this = $(this);  
        let userID = parseInt($('.text-first h6').data('user'));
        let productID = parseInt($this.data('add'));             
        $.ajax({
            url: '../function/add_to_cart.php',
            type: 'POST',
            data: {user: userID, product: productID},
            success: function(response) {
                fetchCart();
            }
        });
    });


    $('.delete').on("click", function() {     
        let $this = $(this);  
        let userID = parseInt($('.text-first h6').data('user'));
        let cartID = parseInt($this.data('del'));             
        $.ajax({
            url: '../function/delete_cart.php',
            type: 'POST',
            data: {user: userID, cart: cartID},
            success: function(response) {
              window.location.reload();
            }
        });
    });


    
    function fetchCart() {
       let userID = parseInt($('.text-first h6').data('user'));
    $.ajax({
        url: '../function/fetch_cart.php',
        type: 'POST',
        data: { user: userID },
        success: function(response) {
            let records = JSON.parse(response);
            $('.cart-icon span').text(records.total_records);
        }
    });
}


$('.likes').on("click", function() {     
    let $this = $(this);  
    let userID = parseInt($('.text-first h6').data('user'));
    let commentID = parseInt($this.data('comment'));             
    $.ajax({
        url: '../function/updateLikes.php',
        type: 'POST',
        data: {user: userID, comment: commentID},
        success: function(response) {
            $('.once-like').text(records.total_records);
        }
    });
});


    
});


$('.add-to-card').on('click',function(){
    var cart = $('.cart-icon');
    var dragImage = $(this).closest('.cards').find("img").eq(0);   
    if(dragImage){
     var imgclone = dragImage.clone().offset({
         top: dragImage.offset().top,
         left: dragImage.offset().left
     }).css({
         'opacity':'0.5',
         'position': 'absolute',
         'height':'150px',
         'width':'150px',
         'z-index':'100'
     }).appendTo($('body')).animate({
             'top': cart.offset().top + 10,
             'left': cart.offset().left + 10,
             'width': 75,
             'height': 75
     },1000, 'easeInOutExpo');
    
     setTimeout(function () {
         cart.effect("shake", {
             times: 2
         }, 200);
     }, 1500);

     imgclone.animate({
         'width': 0,
         'height': 0
     }, function () {
         $(this).detach()
     });
 }
});


$(document).ready(function() {
    const ratingElements = $('.rate');
    const starContainers = $('.star-rating-display');
    ratingElements.each(function(index) {
        const rating = parseInt($(this).val());  
        const starContainer = $(starContainers[index]);  
     
        displayStars(rating, starContainer);
    });

    function displayStars(rating, starContainer) {
        starContainer.empty();         
       
        for (let i = 0; i < rating; i++) {
            const star = $('<span>').addClass('star').html('★');  
            starContainer.append(star);
        }

        for (let i = rating; i < 5; i++) {
            const star = $('<span>').addClass('star').html('☆'); 
            starContainer.append(star);
        }
    }
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

document.getElementById('edit-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = false; // Enable form inputs for editing
    });

    // Show the "Update Product" and "Cancel" buttons, hide the "Edit" button
    document.getElementById('submit-button').style.display = 'inline'; 
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('cancel-button').style.display = 'inline';
});

document.getElementById('cancel-button').addEventListener('click', function() {
    var formElements = document.querySelectorAll('#product-form input, #product-form select, #product-form textarea');
    formElements.forEach(function(element) {
        element.disabled = true; // Disable form inputs when canceling
    });

    // Hide the "Update Product" and "Cancel" buttons, show the "Edit" button
    document.getElementById('submit-button').style.display = 'none';
    document.getElementById('edit-button').style.display = 'inline';
    document.getElementById('cancel-button').style.display = 'none';
    
    // Optional: reset form fields to original values
    document.getElementById('product-form').reset();
    document.getElementById('product-photo').src = '../uploads/<?= htmlspecialchars($product->product_photo) ?>';
});

// Initially, disable all input fields and hide the "Update Product" button
document.querySelectorAll('#product-form input, #product-form select, #product-form textarea').forEach(function(element) {
    element.disabled = true;
});

document.getElementById('submit-button').style.display = 'none'; // Hide the submit button by default

document.getElementById('select-all').addEventListener('click', function() {
    let checkboxes = document.querySelectorAll('.product-checkbox');
    for (let checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});