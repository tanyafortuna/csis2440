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
  <link rel="stylesheet" type="text/css" href="css/order-summary.css">
  <title>ACME Corporation</title>
</head>
  <?php include_once("includes/nav.php"); ?>

  <main>
    <section id="order-confirmation">
      <h1>THANK YOU FOR YOUR ORDER</h1>
      <div id="order-blurbs">
        <p class="order-blurb">You did it! Your order is locked, loaded, and being handled with the utmost care (and minimal explosions). Stay tuned — it's only a matter of time before it all arrives in glorious ACME fashion. Your next big scheme is officially in motion.</p>
        <p class="order-blurb">As always, payment is due on delivery (brace yourself). Full details about your order are below — and saved to your order history for future scheming. Now all that's left is to prepare for impact and start plotting your next move.</p>
      </div>

      <?php 
        include_once("includes/order-summary.php");
        printOrderSummary($_POST['oid']);  
      ?>
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>


<?php

?>