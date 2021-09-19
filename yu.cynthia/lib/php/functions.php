<?php

session_start();




function pretty_dump($data) {
   echo "<pre>",var_dump($data),"</pre>";
}


function file_get_json($filename) {
   $data_string = file_get_contents($filename);
   return json_decode($data_string);
}


/* DATABASE CONNECTION */
function MYSQLIConn() {
   @include_once "data/auth.php";
   if (!function_exists('MYSQLIAuth')) {
      @include_once "../data/auth.php";
   }

   @$conn = new mysqli(...MYSQLIAuth());

   if($conn->connect_errno)
      die($conn->connect_error);

   $conn->set_charset('utf8');

   return $conn;
}

/* DATABASE CALL */
function MYSQLIQuery($sql) {
   $conn = MYSQLIConn();

   $a =[];

   $result = $conn->query($sql);

   if($conn->errno)
      die($conn->error);

   while($row = $result->fetch_object()) {
      $a[] = $row;
   }

   return $a;
}








// CART FUNCTIONS
function array_find($array,$fn) {
   foreach($array as $o) if($fn($o)) return $o;
   return false;
}

function getCart() {
   return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
}

function setCart($a) {
   $_SESSION['cart'] = $a;
}

function resetCart() { setCart([]); }

function cartItemById($id) {
   return array_find(getCart(),function($o)use($id){ return $o->id==$id; });
}

function addToCart($id,$amount) {
   $cart = getCart();

   $p = cartItemById($id);

   if($p) $p->amount = $amount;
   else {
      $cart[] = (object) [
         "id"=>$id,
         "amount"=>$amount
      ];
   }

   setCart($cart);
}


function getCartItems() {
   $cart = getCart();

   if(!count($cart)) {
      return [];
   }

   $ids = implode(",",array_map(function($o){return $o->id;},$cart));

   $products = MYSQLIQuery("
      SELECT *
      FROM `products`
      WHERE `id` IN ($ids)
   ");

   return array_map(function($db_product)use($cart) {
      $cart_product = cartItemById($db_product->id);
      $db_product->amount = $cart_product->amount;
      $db_product->total = $cart_product->amount * $db_product->price;
      return $db_product;
   },$products);
}



function makeCartBadge() {
   $cart = getCart();
   return count($cart)==0 ? "" :
      array_reduce($cart,function($r,$o){return $r+$o->amount;},0);
}






function setDefault($k,$v){
   if(!isset($_GET[$k])) $_GET[$k] = $v;
}