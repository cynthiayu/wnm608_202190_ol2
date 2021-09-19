<?php

include "lib/php/functions.php";

// pretty_dump($_POST);

$product = MYSQLIQuery("SELECT * FROM `products` WHERE `id`=".$_GET['id'])[0];
$cart_product = cartItemById($product->id);

//pretty_dump($product);

?><!DOCTYPE html>
<html lang="en">
<head>
   <title>Added To Cart</title>
   
   <?php include "parts/meta.php" ?>
</head>
<body>
   <?php include "parts/navbar.php" ?>
   

   <div class="container">
      <div class="card soft">
         <?php

         if(!isset($_GET['id'])) {
            echo "You dun goofed";
         } else {
            ?>
            <h2><?= $cart_product->amount ?> <?= $product->title ?> In Your Cart</h2>

            <div class="display-flex">
               <div class="flex-none"><a class="form-button" href="javascript:window.history.back();">Back To Product</a></div>
               <div class="flex-stretch"></div>
               <div class="flex-none"><a class="form-button" href="product_list.php">Continue Shopping</a></div>
            </div>
            <?
         }
         ?>
      </div>
   </div>
</body>
</html>