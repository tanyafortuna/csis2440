<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');

  // error reporting
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <link rel="stylesheet" type="text/css" href="css/cart.css">
  <script src="js/script.js" defer></script>
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/nav.php"); 
  ?>
  <main>
    <section id="cart">
      <h1>YOUR CART</h1>
      <div id="cart-detail">
        <div class="left-side">
          <div id="cart-header">
            <p></p>
            <p id="cart-header-name">PRODUCT NAME</p>
            <p id="cart-header-each">EACH</p>
            <p id="cart-header-qty">QTY</p>
            <p id="cart-header-total">TOTAL</p>
          </div>
          <div class="cart-item">
            <div><img class="cart-item-img" src="img/product-images/13.jpg"></div>
            <div class="cart-item-name"><p>Iron Carrot</p></div>
            <div class="cart-item-price-each">$38.99</div>
            <div class="cart-item-qty">2</div>
            <div class="cart-item-price-total">$77.98</div>
          </div>
          <div class="cart-item">
            <img class="cart-item-img" src="img/product-images/12.jpg">
            <div class="cart-item-name"><p>Iron Carrot</p></div>
            <div class="cart-item-price-each">$38.99</div>
            <div class="cart-item-qty">2</div>
            <div class="cart-item-price-total">$77.98</div>
          </div>
          <div class="cart-total">
            Total: $10000000000
          </div>
        </div>
        <div class="right-side">
          <div class="summary" id="summary-shipping">
            <div class="summary-left">Shipping</div>
            <div class="summary-right">$15.75</div>
          </div>
          <div class="summary" id="summary-discount">
            <div class="summary-left">Discount</div>
            <div class="summary-right">-$0.00</div>
          </div>
          <div class="summary" id="summary-tax">
            <div class="summary-left">Tax</div>
            <div class="summary-right">$7.45</div>
          </div>
          <div class="summary" id="summary-total">
            <div class="summary-left">Grand Total</div>
            <div class="summary-right">$567.45</div>
          </div>
          <p id="free-shipping-carrot">You're only <span>$432.55</span> away from free shipping!</p>
          <div id="checkout" class="button-container">
            <a href="#">CHECKOUT</a>
          </div>
        </div>
      </div>
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>