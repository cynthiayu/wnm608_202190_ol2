<?php

include "lib/php/functions.php";

$product = makeStatement("product_by_id")[0];

$thumbs = explode(",", $product->image_other);

$thumb_elements = array_reduce($thumbs,function($r,$o){
   return $r."<img src='/images/store/$o'>";
});

?><!DOCTYPE html>
<html lang="en">
<head>
   <title>Product List</title>
   
   <?php include "parts/meta.php" ?>
</head>
<body>
   <?php include "parts/navbar.php" ?>
   

   <div class="container">
      <div class="grid gap product-display">
         <div class="col-xs-12 col-md-7">
            <div class="card soft">
               <div class="image-main">
                  <img src="/images/store/<?= $product->image_thumb ?>" />
               </div>
               <div class="image-thumbs"><?= $thumb_elements ?></div>
            </div>
         </div>
         <div class="col-xs-12 col-md-5">
            <form class="card soft flat" action="product_actions.php?crud=add-to-cart" method="post">
               <input type="hidden" name="id" value="<?= $product->id ?>">
               <div class="card-section">
                  <div class="product-title"><?= $product->title ?></div>
                  <div class="product-price">&dollar;<?= $product->price ?></div>
               </div>
               <div class="card-section">
                  <label class="form-label">Amount</label>
                  <div class="form-select">
                     <select name="amount">
                        <!-- option[value='$']*10>{$} -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                     </select>
                  </div>
               </div>
               <div class="card-section">
                  <button type="submit" class="form-button sell">Add To Cart</button>
               </div>
            </form>
            <div class="card soft">
               <?= $product->description ?>
            </div>
         </div>
      </div>
   </div>
</body>
</html>