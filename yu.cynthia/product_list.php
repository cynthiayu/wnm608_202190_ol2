<?php

include "lib/php/functions.php";
include "parts/templates.php";
include "data/api.php";

// pretty_dump([$_GET,$_POST]);

setDefault('s',''); // search
setDefault('t','products_all'); // type
setDefault('d','DESC'); // order direction
setDefault('o','date_create'); // order by
setDefault('l','12'); // limit

// pretty_dump($_GET);


function makeSortOptions() {
   $options = [
      ["date_create","DESC","Latest Products"],
      ["date_create","ASC","Oldest Products"],
      ["price","DESC","Highest Price"],
      ["price","ASC","Lowest Price"]
   ];
   foreach($options as [$orderby,$direction,$title]) {
      echo "
      <option data-orderby='$orderby' data-direction='$direction'
      ".($_GET['o']==$orderby && $_GET['d']==$direction ? "selected" : "").">
      $title</option>
      ";
   }
}

function makeFilterSet() {
   $options = [
      "fruit",
      "vegetable"
   ];
   foreach($options as $option) {
      echo "
      <a href='product_list.php?t=products_by_category&category=$option&d={$_GET['d']}&o={$_GET['o']}&l={$_GET['l']}&s={$_GET['s']}' class='form-button inline ".($option==$_GET['category']?"active":"")."'>$option</a>
      ";
   }
}


if(isset($_GET['t'])) {
   $result = makeStatement($_GET['t']);
   $products = isset($result['error']) ? [] : $result;
} else {
   $result = makeStatement("products_all");
   $products = isset($result['error']) ? [] : $result;
}

?><!DOCTYPE html>
<html lang="en">
<head>
   <title>Product List</title>
   
   <?php include "parts/meta.php" ?>
</head>
<body>
   <?php include "parts/navbar.php" ?>

   <div class="container">

      <form action="product_list.php" method="get" class="hotdog" style="margin-top:1em">
         <input type="hidden" name="t" value="search">
         <input type="hidden" name="d" value="<?=$_GET['d']?>">
         <input type="hidden" name="o" value="<?=$_GET['o']?>">
         <input type="hidden" name="l" value="<?=$_GET['l']?>">
         <input type="search" name="s" placeholder="Search" value="<?= $_GET['s'] ?>">
      </form>

      <div>
         <? makeFilterSet() ?>
      </div>

      <form action="product_list.php" method="get">
         <input type="hidden" name="t" value="search">
         <input type="hidden" name="s" value="<?=$_GET['s']?>">
         <input type="hidden" name="d" value="<?=$_GET['d']?>">
         <input type="hidden" name="o" value="<?=$_GET['o']?>">
         <input type="hidden" name="l" value="<?=$_GET['l']?>">
         <div class="form-select">
            <select onChange="checkSort(this)">
               <? makeSortOptions() ?>
            </select>
         </div>
      </form>

      <h2>Product List</h2>

      <div class="grid gap product-list">
      <?php

      if(empty($products)) {
         echo "No products found.";
      } else {
         echo array_reduce($products,'makeProductList');
      }

      ?>
      </div>
   </div>
   <div class="container">
      <div class="card soft"><a href="admin">Product Admin</a></div>
   </div>
</body>
</html>