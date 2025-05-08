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
      <?php 
        if (isset($_SESSION['cart']) && array_sum(array_column($_SESSION['cart'],'qty')) > 0)
          echo printCartContents();
        else
          echo printEmptyCart();

      ?>
      
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>

<!-- Output printing functions -->
<?php
  function printEmptyCart() {
    echo '<h1>YOUR CART</h1>';
    echo '<div id="cart-empty">';
    echo '<p class="cart-blurb">No gadgets, gizmos, or gravity-defying gear—yet. Your cart\'s just waiting for a touch of ACME brilliance (or chaos) to get rolling. Browse our lineup of clever, curious, and questionably safe contraptions to spark your next big idea.</p>';
    echo '</div>';
  }

  function printCartContents() {
    echo '<h1>YOUR CART</h1>';
    echo '<div id="cart-detail">';
    echo '<div class="left-side">';
    echo '<div id="cart-header">';
    echo '<p></p>';

    echo '<p id="cart-header-name">PRODUCT NAME</p>';
    echo '<p id="cart-header-each">EACH</p>';
    echo '<p id="cart-header-qty">QTY</p>';
    echo '<p id="cart-header-total">TOTAL</p>';
    echo '</div>';
    
    printCartItem(13);
    printCartItem(12);
    // foreach ($_SESSION['cart'] as $product) {
    //   printCartItem($product['id']);
    // }

    echo '<div class="cart-total">';
    echo 'Total: $10000000000';
    echo '</div>';
    echo '</div>';

    echo '<div class="right-side">';
    echo '<div class="summary" id="summary-shipping">';
    echo '<div class="summary-left">Shipping</div>';
    echo '<div class="summary-right">$15.75</div>';
    echo '</div>';
    echo '<div class="summary" id="summary-discount">';
    echo '<div class="summary-left">Discount</div>';
    echo '<div class="summary-right">-$0.00</div>';
    echo '</div>';
    echo '<div class="summary" id="summary-tax">';
    echo '<div class="summary-left">Tax</div>';
    echo '<div class="summary-right">$7.45</div>';
    echo '</div>';
    echo '<div class="summary" id="summary-total">';
    echo '<div class="summary-left">Grand Total</div>';
    echo '<div class="summary-right">$567.45</div>';
    echo '</div>';

    echo '<p id="free-shipping-carrot">You\'re only <span>$432.55</span> away from free shipping!</p>';
    echo '<div id="checkout" class="button-container">';
    echo '<a href="#">CHECKOUT</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
  }

  function printCartItem($id) {
    echo '<div class="cart-item">';
    echo '<img class="cart-item-img" src="img/product-images/'.$id.'.jpg">';
    echo '<div class="cart-item-name"><p>Iron Carrot</p></div>';
    echo '<div class="cart-item-price-each">$38.99</div>';
    echo '<div class="cart-item-qty">2</div>';
    echo '<div class="cart-item-price-total">$77.98</div>';
    echo '</div>';
  }

?>