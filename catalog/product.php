<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');

  if (!isset($_GET['id']) || $_GET['id'] < 1 || $_GET['id'] > 20) 
    header('location: .');

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
  <script src="js/script.js" defer></script>
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
              <a href="#">ADD TO CART</a>
            </div>
          </div>
        </div>  
      </div>  
    </section>
  </main>

  


  
  <footer></footer>

  
</body>
</html>