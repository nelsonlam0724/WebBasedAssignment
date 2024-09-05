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
        let productID = parseInt($this.data('addCart'));             
        $.ajax({
            url: '../function/add_to_cart.php',
            type: 'POST',
            data: {user: userID, product: productID},
            success: function(response) {
                let checkClick = JSON.parse(response);
                if (checkClick.success) {
                    alert(checkClick.message);
                } else {
                    alert('Error adding product to cart');
                }
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