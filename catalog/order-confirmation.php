<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');

  // process order
  if (!isset($_POST['checkout'])) header('location: .');
  else { processOrder($_POST['oid']); }

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
  <link rel="stylesheet" type="text/css" href="css/ads.css">
  <link rel="stylesheet" type="text/css" href="css/order-confirmation.css">
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/nav.php"); 
  ?>
  <main>
    <section id="order-confirmation">
      <h1>THANK YOU FOR YOUR ORDER</h1>
      <div id="order-blurbs">
        <p class="order-blurb">You did it! Your order is locked, loaded, and being handled with the utmost care (and minimal explosions). Stay tuned — it's only a matter of time before it all arrives in glorious ACME fashion. Your next big scheme is officially in motion.</p>
        <p class="order-blurb">As always, payment is due on delivery (brace yourself). Full details about your order are below — and saved to your order history for future scheming. Now all that's left is to prepare for impact and start plotting your next move.</p>
      </div>
      <h1>ORDER #<?php echo $_POST['oid']; ?> - PLACED 
        <?php echo getOrderInfo($_POST['oid'])['order_date']; ?>
      </h1>
      <div id="order-summary">
        <div class="left-side">
          <div id="order-header">
            <p id="order-header-name">PRODUCT NAME</p>
            <p id="order-header-each">EACH</p>
            <p id="order-header-qty">QTY</p>
            <p id="order-header-total">TOTAL</p>
          </div>
          <!-- foreach loop to print items ordered -->
          <?php 
            $items = getOrderLineItems($_POST['oid']);
            foreach ($items as $pid => $qty) { printOrderItem($pid, $qty); }
          ?>
          <!-- foreach loop to print items ordered -->
          <div class="order-subtotal">Subtotal: $
            <span id="order-subtotal">
            <?php echo number_format(getOrderSubtotal($_POST['oid']), 2); ?>
            </span>
          </div>
        </div>

        <div class="right-side">
          <div id="summary-heading">ORDER SUMMARY</div>
            <div class="summary" id="summary-shipping">
            <div class="summary-left">Delivery</div>
            <div class="summary-right">$
              <span id="order-delivery">
              <?php echo number_format(getOrderShipping($_POST['oid']), 2); ?>
              </span>
            </div>
          </div>
          <div class="summary" id="summary-discount">
            <div class="summary-left">Discount</div>
            <div class="summary-right">-$0.00</div>
          </div>
          <div class="summary" id="summary-tax">
            <div class="summary-left">Tax</div>
            <div class="summary-right">$
              <span id="order-tax">
              <?php echo number_format(getOrderTax($_POST['oid']), 2); ?>
              </span>
            </div>
          </div>
          <div class="summary" id="summary-total">
            <div class="summary-left">Grand Total</div>
            <div class="summary-right">$
              <span id="order-total">
              <?php echo number_format(getOrderTotal($_POST['oid']), 2); ?>
              </span>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>

<?php
  function printOrderItem($pid, $qty) {
    $product = getProductFromDB($pid);

    echo '<div class="order-item">';

    echo '<div class="order-item-name">';
    echo '<p>'.$product['name'].'</p>';
    echo '</div>';

    echo '<div class="order-item-price-each">$';
    echo number_format($product['price'], 2);
    echo '</div>';

    echo '<div class="order-item-qty">';
    echo $qty;
    echo '</div>';

    echo '<div class="order-item-price-total">$';
    echo number_format($product['price'] * $qty, 2);
    echo '</div>';
    echo '</div>';
  }
?>