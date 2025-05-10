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
  <link rel="stylesheet" type="text/css" href="css/new-arrivals.css">
  <link rel="stylesheet" type="text/css" href="css/product-card.css">
  <title>ACME Corporation</title>
</head>
<body>
  <?php 
    include_once("includes/product-card.php");
    include_once("includes/nav.php"); 
  ?>

  <main>
    <section id="new-arrivals">
      <h1>NEW ARRIVALS</h1>
      <p id="new-arrivals-blurb">Fresh from the lab and questionably approved, our newest ACME arrivals are here to shake up your toolkit — and possibly your surroundings. Browse the latest innovations in speed, surprise, and cartoon-grade chaos.</p>
      <div id="new-products">
        <?php
          echo generateProductCard(13);
          echo generateProductCard(12);
          echo generateProductCard(3);
          echo generateProductCard(18);
        ?>
      </div>
    </section>
  </main>

  <?php include_once("includes/footer.php"); ?>
</body>
</html>