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

  // process promo code form
  if (isset($_POST['apply-discount'])) {
    getPromoDiscount(strtoupper($_POST['code']));
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

    // Left side
    echo '<div class="left-side">';
    echo '<div id="cart-header" class="common-border-bottom">';
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

    // Right side
    echo '<div class="right-side">';
    echo '<div id="summary-heading" class="common-border-bottom">CART SUMMARY</div>';

    // Summary area
    echo '<div class="summary" id="summary-subtotal">';
    echo '<div class="summary-left">Subtotal</div>';
    echo '<div class="summary-right">$<span id="cart-subtotal">';
    echo number_format(getCartSubtotal(), 2);
    echo '</span></div>';
    echo '</div>';
    echo '<div class="summary" id="summary-discount">';
    echo '<div class="summary-left">Discount</div>';
    echo '<div class="summary-right">-$<span id="cart-discount">';
    echo number_format(getCartDiscount(), 2);
    echo '</span></div>';
    echo '</div>';
    echo '<div class="summary" id="summary-shipping">';
    echo '<div class="summary-left">Delivery</div>';
    echo '<div class="summary-right">$<span id="cart-delivery">';
    echo number_format(getCartShipping(), 2);
    echo '</span></div>';
    echo '</div>';
    echo '<div class="summary" id="summary-tax">';
    echo '<div class="summary-left">Tax</div>';
    echo '<div class="summary-right">$<span id="cart-tax">';
    echo number_format(getCartTax(), 2);
    echo '</span></div>';
    echo '</div>';
    echo '<div class="summary common-border-top" id="summary-total">';
    echo '<div class="summary-left">Grand Total</div>';
    echo '<div class="summary-right">$<span id="cart-total">';
    echo number_format(getCartTotal(), 2);
    echo '</span></div>';
    echo '</div>';

    // Alerts
    echo '<div class="alerts">';
    echo '<p id="free-shipping-carrot">';
    if ((getCartSubtotal() - getCartDiscount()) < 999) {
      echo 'You\'re only <span>$';
      echo number_format(getFreeShippingCarrot(), 2);
      echo '</span> away from free delivery!';
    }
    else { echo 'You\'re getting free delivery!'; }
    echo '</p>';
    
    if (isset($_SESSION['discount_code'])) {
      echo '<p id="promo-success">Wahoo! Enjoy your <span id="discount-amt">';
      echo $_SESSION['discount_amt'];
      echo '</span>% off.</p>';
    }
    echo '</div>';

    // Checkout button
    echo '<div id="checkout" class="button-container">';
    echo '<form method="post" action="order-confirmation.php">';
    echo '<input type="hidden" name="oid" id="oid" value="';
    echo getLargestOrderNum() + rand(9, 19);
    echo '">';
    echo '<input type="submit" class="button" id="checkout" name="checkout" value="CHECKOUT">';
    echo '</form>';
    echo '</div>';
    
    // Promo code entry
    if (!isset($_SESSION['discount_code'])) {
      echo '<div id="promo" class="common-border-top">';
      echo '<p>Got a promo code?</p>';
      
      echo '<form method="post">';
      echo '<input type="text" id="code" name="code" maxlength="10">';
      echo '<input type="submit" class="button smaller" id="apply-discount" name="apply-discount" value="APPLY">';
      echo '</form>';
      
      if (isset($_POST['apply-discount']))
        echo '<p id="promo-error">That one\'s not working. Try again.</p>';

      echo '</div>';
  }

    // Close right side
    echo '</div>';

    // Close container div
    echo '</div>';
  }

  function printCartItem($id, $qty) {
    $product = getProductFromDB($id);

    echo '<div class="cart-item common-border-bottom" id="cart-item-'.$id.'">';
    echo '<img class="cart-item-img" src="'.$product['image'].'" alt="Product image">';

    echo '<div class="cart-item-name">';
    echo '<p class="top">'.$product['name'].'</p>';
    echo '<div class="remove-item" onclick="removeItemFromCart('.$id.');">';
    echo '<p class="bottom" id="remove-item-'.$id.'">';
    echo '<img class="icon" src="img/icons/delete.png" alt="Delete icon">';
    echo '<span>Remove item</span></p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="cart-item-price-each">$';
    echo '<span id="cart-item-price-each-'.$id.'">';
    echo number_format($product['price'], 2);
    echo '</span></div>';

    echo '<div class="cart-item-qty">';
    echo '<div id="qty-minus" onclick="updateCartItemQty(false, '.$id.');">';
    echo '<img class="icon" src="img/icons/minus.png" alt="Minus icon">';
    echo '</div>';
    echo '<div id="qty-count-'.$id.'">'.$qty.'</div>';
    echo '<div id="qty-plus" onclick="updateCartItemQty(true, '.$id.');">';
    echo '<img class="icon" src="img/icons/plus.png" alt="Plus icon">';
    echo '</div>';
    echo '</div>';

    echo '<div class="cart-item-price-total">$';
    echo '<span id="cart-item-price-total-'.$id.'">';
    echo number_format($product['price'] * $qty, 2);
    echo '</span></div>';
    echo '</div>';
  }
?>