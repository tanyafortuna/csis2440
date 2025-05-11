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
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <link rel="stylesheet" type="text/css" href="css/ads.css">
  <link rel="stylesheet" type="text/css" href="css/cart.css">
  <script src="js/cart-script.js" defer></script>
  <title>ACME Corporation</title>
</head>
<body>
  <?php include_once("includes/nav.php"); ?>

  <main>
    <section id="cart" class="common height">
      <?php 
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart']))
          echo printCartContents();
        else
          echo printEmptyCart();
      ?>
      <?php include_once("includes/ads.php"); ?>
    </section>
    
  </main>
  
  <?php include_once("includes/footer.php"); ?>
</body>
</html>

<!-- Output printing functions -->
<?php
  function printEmptyCart() {
    echo '<h1 class="common padded">YOUR CART IS EMPTY</h1>';
    echo '<div id="cart-empty" class="common subsection">';
    echo '<p class="cart-blurb common">No gadgets, gizmos, or gravity-defying gear — yet. Your cart\'s just waiting for a touch of ACME brilliance (or chaos) to get rolling. Browse our lineup of clever, curious, and questionably safe contraptions to spark your next big idea.</p>';
    echo '</div>';
    include_once("includes/ads.php");
  }

  function printCartContents() {
    echo '<h1 class="common padded">YOUR CART</h1>';
    echo '<p class="cart-blurb common">Looking good — your cart\'s locked, loaded, and fully primed for high-octane mischief. These ACME-grade contraptions are one step away from joining your next brilliant (or baffling) plan. All systems go - we\'re ready when you are.</p>';
    echo '<div id="cart-detail" class="common subsection">';
    echo '<div class="left-side">';
    echo '<div id="cart-header">';
    echo '<p></p>';

    echo '<p id="cart-header-name">PRODUCT NAME</p>';
    echo '<p id="cart-header-each">EACH</p>';
    echo '<p id="cart-header-qty">QTY</p>';
    echo '<p id="cart-header-total">TOTAL</p>';
    echo '</div>';
    
    foreach ($_SESSION['cart'] as $id => $qty) {
      printCartItem($id, $qty);
    }

    echo '</div>';

    echo '<div class="right-side">';
    echo '<div id="summary-heading">CART SUMMARY</div>';


    echo '<div class="summary" id="summary-subtotal">';
    echo '<div class="summary-left">Subtotal</div>';
    echo '<div class="summary-right">$<span id="cart-subtotal">';
    echo number_format(getCartSubtotal(), 2);
    echo '</span></div>';
    echo '</div>';

    echo '<div class="summary" id="summary-shipping">';
    echo '<div class="summary-left">Delivery</div>';
    echo '<div class="summary-right">$<span id="cart-delivery">';
    echo number_format(getCartShipping(), 2);
    echo '</span></div>';
    echo '</div>';
    echo '<div class="summary" id="summary-discount">';
    echo '<div class="summary-left">Discount</div>';
    echo '<div class="summary-right">-$0.00</div>';
    echo '</div>';
    echo '<div class="summary" id="summary-tax">';
    echo '<div class="summary-left">Tax</div>';
    echo '<div class="summary-right">$<span id="cart-tax">';
    echo number_format(getCartTax(), 2);
    echo '</span></div>';
    echo '</div>';
    echo '<div class="summary" id="summary-total">';
    echo '<div class="summary-left">Grand Total</div>';
    echo '<div class="summary-right">$<span id="cart-total">';
    echo number_format(getCartTotal(), 2);
    echo '</span></div>';
    echo '</div>';

    echo '<p id="free-shipping-carrot">';
    if (getCartSubtotal() < 999) {
      echo 'You\'re only <span>$';
      echo number_format(getFreeShippingCarrot(), 2);
      echo '</span> away from free delivery!';
    }
    else { echo 'You\'re getting free delivery!'; }
    echo '</p>';

    echo '<div id="checkout" class="button-container">';
    echo '<form method="post" action="order-confirmation.php">';
    echo '<input type="hidden" name="oid" id="oid" value="';
    echo getLargestOrderNum() + rand(9, 19);
    echo '">';
    echo '<input type="submit" class="button" id="checkout" name="checkout" value="CHECKOUT">';
    echo '</form>';

    echo '</div>';
    echo '</div>';
    echo '</div>';
  }

  function printCartItem($id, $qty) {
    $product = getProductFromDB($id);

    echo '<div class="cart-item" id="cart-item-'.$id.'">';
    echo '<img class="cart-item-img" src="'.$product['image'].'">';

    echo '<div class="cart-item-name">';
    echo '<p class="top">'.$product['name'].'</p>';
    echo '<div class="remove-item" onclick="removeItemFromCart('.$id.');">';
    echo '<p class="bottom" id="remove-item-'.$id.'">';
    echo '<img class="icon" src="img/icons/delete.png">';
    echo '<span>Remove item</span></p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="cart-item-price-each">$';
    echo '<span id="cart-item-price-each-'.$id.'">';
    echo number_format($product['price'], 2);
    echo '</span></div>';

    echo '<div class="cart-item-qty">';
    echo '<div id="qty-minus" onclick="updateCartItemQty(false, '.$id.');">';
    echo '<img class="icon" src="img/icons/minus.png">';
    echo '</div>';
    echo '<div id="qty-count-'.$id.'">'.$qty.'</div>';
    echo '<div id="qty-plus" onclick="updateCartItemQty(true, '.$id.');">';
    echo '<img class="icon" src="img/icons/plus.png">';
    echo '</div>';
    echo '</div>';

    echo '<div class="cart-item-price-total">$';
    echo '<span id="cart-item-price-total-'.$id.'">';
    echo number_format($product['price'] * $qty, 2);
    echo '</span></div>';
    echo '</div>';
  }
?>