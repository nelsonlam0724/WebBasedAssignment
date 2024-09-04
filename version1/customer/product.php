<?php 
  include '../_base.php';
  
  $getProduct = $_db->query('SELECT * FROM product ');

  include '../include/header.php';
  
  ?>
  <link rel="stylesheet" href="../css/product.css">
    <div class="items">
        <div class="line1">
        <p>763 product</p>
        <p style="cursor:pointer;background-color:yellow;padding:6px;">Filter <i class='bx bx-filter'></i></p>
        </div>      

        <div class="items-lists">

        <?php foreach ($getProduct as $i): ?>
            <div class="items-card">

               <img src="<//?= $i->product_photo ?>" width="100" height="200">

               <div class="text2">
                 <p class="product-name space"> <?= $i->name ?></p>
                 <p class="product-price space">RM <?= $i->price ?></p>
                 <p class="product-stock space"><?= $i->name ?> Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

        <div class="button-select">
           <div class="wishlist" data-productid="<?= $i->product_id ?>"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
              
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
           

              <a href="#">
                    <div class="view-product">
                           <a href="items.php?id=1"><p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p></a>
                </div>
              </a>
       </div>
               </div>
               
        
            </div>
            <?php endforeach ?>



             <!-- <div class="items-card">

               <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" width="100" height="200">

               <div class="text2">
                 <p class="product-name space">Tady Bear</p>
                 <p class="product-price space">RM 22</p>
                 <p class="product-stock space">123 Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

        <div class="button-select">
           <div class="wishlist" data-userid="1" data-productid="6"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
           
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
         

              <a href="#">
                    <div class="view-product">
                           <p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </div>
              </a>
       </div>
               </div>


            </div>

            <div class="items-card">

               <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" width="100" height="200">

               <div class="text2">
                 <p class="product-name space">Tady Bear</p>
                 <p class="product-price space">RM 22</p>
                 <p class="product-stock space">123 Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

        <div class="button-select">
           <div class="wishlist" data-userid="1" data-productid="29"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
            
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
         

              <a href="#">
                    <div class="view-product">
                           <p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </div>
              </a>
       </div>
               </div>


            </div>

            <div class="items-card">

               <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" width="100" height="200">

               <div class="text2">
                 <p class="product-name space">Tady Bear</p>
                 <p class="product-price space">RM 22</p>
                 <p class="product-stock space">123 Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

               

        <div class="button-select">
           <div class="wishlist" data-userid="4" data-productid="21"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
               
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
              

              <a href="#">
                    <div class="view-product">
                           <p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </div>
              </a>
       </div>
               </div>


            </div>



            <div class="items-card">

               <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" width="100" height="200">

               <div class="text2">
                 <p class="product-name space">Tady Bear</p>
                 <p class="product-price space">RM 22</p>
                 <p class="product-stock space">123 Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

        <div class="button-select">
           <div class="wishlist" data-userid="1" data-productid="22"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
          
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
          

              <a href="#">
                    <div class="view-product">
                           <p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </div>
              </a>
       </div>
               </div>


            </div>





            <div class="items-card">

               <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" width="100" height="200">

               <div class="text2">
                 <p class="product-name space">Tady Bear</p>
                 <p class="product-price space">RM 22</p>
                 <p class="product-stock space">123 Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

        <div class="button-select">
           <div class="wishlist" data-userid="1" data-productid="9"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
            
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
              

              <a href="#">
                    <div class="view-product">
                           <p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </div>
              </a>
       </div>
               </div>


            </div>



            <div class="items-card">

               <img src="https://www.bing.com/th?id=OIP.CJUZPzHxXG_PeTDV4UuojQHaF0&w=200&h=150&c=8&rs=1&qlt=90&o=6&dpr=1.2&pid=3.1&rm=2" width="100" height="200">

               <div class="text2">
                 <p class="product-name space">Tady Bear</p>
                 <p class="product-price space">RM 22</p>
                 <p class="product-stock space">123 Stock</p>
                 <p class="product-sold space">22 sold</p>
               </div>

        <div class="button-select">
           <div class="wishlist" data-userid="1" data-productid="3"><p><i class="fa fa-heart"></i></p></div>
            <div class="selection-button">
            
                    <div class="add-to-card">
                           <p><i class='bx bx-cart' style="font-size:24px"></i> Add To Card</p>
                </div>
            

              <a href="#">
                    <div class="view-product">
                           <p><i class="fa fa-eye" style="font-size:24px"></i> View Product</p>
                </div>
              </a>
       </div>
               </div>


            </div>        -->

        </div>
    </div>
</body>
<script src="../js/product.js"></script>
<script></script>
</html>