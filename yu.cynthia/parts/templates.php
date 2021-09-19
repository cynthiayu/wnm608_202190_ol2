<?php

function makeProductList($r,$o) {
return $r.<<<HTML
<div class="col-xs-12 col-sm-6 col-md-4">
   <a href="product_item.php?id=$o->id" class="product">
      <div class="product-image">
         <img src="/images/store/$o->image_thumb" alt="">
      </div>
      <figcaption class="product-caption">
         <div class="product-price">&dollar;$o->price</div>
         <div class="product-title">$o->title</div>
      </figcaption>
   </a>
</div>
HTML;
}



function selectAmount($amount=1,$total=10) {
   $output = "<select name='amount'>";
   for($i=1;$i<$total;$i++) {
      $output .= "<option ".($i==$amount?'selected':'').">$i</option>";
   }
   $output .= "</select>";
   return $output;
}




function makeCartList($r,$o) {
$totalfixed = number_format($o->total,2,'.','');
$amountselect = selectAmount($o->amount,10);
return $r.<<<HTML
<div class="display-flex card-section">
   <div class="flex-none image-thumbs">
      <img src="/images/store/$o->image_thumb">
   </div>
   <div class="flex-stretch">
      <strong>$o->title</strong>
      <form action="product_actions.php?crud=delete-cart-item" method="post" style="font-size:0.8em">
         <input type="hidden" name="id" value="$o->id">
         <input type="submit" value="delete" class="form-button inline">
      </form>
   </div>
   <div class="flex-none">
      <div>&dollar;$totalfixed</div>
      <form action="product_actions.php?crud=update-cart-item" method="post" onchange="this.submit()" style="font-size:0.8em">
         <input type="hidden" name="id" value="$o->id">
         <div class="form-select">
            $amountselect
         </div>
      </form>
   </div>
</div>
HTML;
}



function cartTotals() {
$cart = getCartItems();

$cartprice = array_reduce($cart,function($r,$o){return $r+$o->total;},0);

$pricefixed = number_format($cartprice,2,".","");
$tax = number_format($cartprice*0.0275,2,".","");
$taxed = number_format($cartprice*1.0275,2,".","");

return <<<HTML
<div class="card-section display-flex">
   <div class="flex-stretch">
      <strong>Sub Total</strong>
   </div>
   <div class="flex-none">&dollar;$pricefixed</div>
</div>
<div class="card-section display-flex">
   <div class="flex-stretch">
      <strong>Taxes</strong>
   </div>
   <div class="flex-none">&dollar;$tax</div>
</div>
<div class="card-section display-flex">
   <div class="flex-stretch">
      <strong>Total</strong>
   </div>
   <div class="flex-none">&dollar;$taxed</div>
</div>
HTML;
}
// use this for repeating pattern in HTML < > HTML