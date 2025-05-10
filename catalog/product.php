<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');

  // invalid product id redirect
  if (!isset($_GET['id']) || $_GET['id'] < 1 || $_GET['id'] > 20) 
    header('location: .');

  // customer clicked add to cart
  if (isset($_POST['buy-now'])) {
    $pid = $_POST['product-id'];
    $pqty = $_POST['product-qty'];
    
    if (isGranted()) {
      addItemtoSession($pid, $pqty);
      header('location: cart.php');
    }
    else header('location: login.php?pid='.$pid.'&qty='.$pqty);
  }
  
  // error reporting
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }

  // product info
  $product = getProductFromDB($_GET['id']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <link rel="stylesheet" type="text/css" href="css/product.css">
  <script src="js/product-script.js" defer></script>
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/product-card.php");
    include_once("includes/nav.php"); 
  ?>

  <main>
    <section id="product">
      <div id="product-detail">
        <div class="left-side">
          <img id="product-img" src="<?php echo $product['image']; ?>">
        </div>    
        <div class="right-side">
          <h1 class="name"><?php echo strtoupper($product['name']); ?></h1>
          <p class="reviews-count">
            <img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png">
            23 Reviews
          </p>
          <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
          <p id="product-blurb"><?php echo $product['description']; ?></p>
          <form method="post">
            <div id="qty-and-cart">
              <div id="qty-selector">
                <p id="qty">Qty:</p>
                <div id="qty-minus-plus">
                  <div id="qty-minus" onclick="updateProductPageQty(false);">
                    <img class="icon" src="img/icons/minus.png">
                  </div>
                  <div id="qty-count">
                    1
                  </div>
                  <div id="qty-plus" onclick="updateProductPageQty(true);">
                    <img class="icon" src="img/icons/plus.png">
                  </div>
                </div>
              </div>
              <div class="button-container" id="add-to-cart">
                <input type="submit" class="button" id="buy-now" name="buy-now"
                <?php echo (isGranted() ? 'value="ADD TO CART"' : 'value="LOG IN & ADD TO CART"'); ?>
                >
              </div>
              <input type="hidden" id="product-id" name="product-id" value="<?php echo $_GET['id'] ?>">
              <input type="hidden" id="product-qty" name="product-qty" value="1">
            </div>
          </form>
        </div>  
      </div>  
    </section>
  </main>

  


  
  <footer></footer>

  
</body>
</html>