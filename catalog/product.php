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
          <img id="product-img" src="img/product-images/13.jpg">
        </div>    
        <div class="right-side">
          <h1 class="name">IRON CARROT</h1>
          <p class="reviews-count">
            <img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png"><img class="icon" src="img/icons/star-full.png">
            23 Reviews
          </p>
          <p class="price">$38.99</p>
          <p id="product-blurb">
            ACME Corporation's latest breakthrough in high-performance produce-inspired tech. <BR><BR>Engineered for speed, impact, and questionable practicality, this sleek, carrot-shaped innovation is already turning heads (and breaking windows) across the country. <BR><BR>Whether you're chasing, fleeing, or just want to make an impression at the local canyon edge, the Iron Carrot delivers unstoppable reliability with signature ACME style.<br><br>Limited quantities available — get yours today!
          </p>
          <div id="qty-and-cart">
            <div id="qty-selector">
              <p id="qty">Qty:</p>
              <div id="qty-minus-plus">
                <div id="qty-minus">
                  <img class="icon" src="img/icons/minus.png">
                </div>
                <div id="qty-count">
                  1
                </div>
                <div id="qty-plus">
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