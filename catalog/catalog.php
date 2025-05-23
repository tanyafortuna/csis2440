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
  <link rel="stylesheet" type="text/css" href="css/catalog.css">
  <link rel="stylesheet" type="text/css" href="css/product-card.css">
  <title>ACME Corporation</title>
</head>
<body>
  <?php 
    include_once("includes/product-card.php");
    include_once("includes/nav.php"); 
  ?>
  
  <main>
    <section id="catalog" class="common height">
      <h1 class="common padded">ALL PRODUCTS</h1>
      <p id="all-products-blurb" class="common">From classics that defy physics to gadgets no one asked for but everyone needs, ACME's full lineup is engineered for maximum impact and minimal hesitation. Whether you're cooking up an ambitious plan or dodging the consequences, there's a product for every improbable scenario and every daredevil customer.</p>
      <div id="all-products">
        <?php
          for ($i = 0; $i < 20; $i++) {
            echo generateProductCard($i + 1);
          }
        ?>
      </div>
    </section>
  </main>
  
  <?php include_once("includes/footer.php"); ?>
</body>
</html>