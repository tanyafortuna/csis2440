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
  <link rel="stylesheet" type="text/css" href="css/account.css">
  <link rel="stylesheet" type="text/css" href="css/order-summary.css">
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/nav.php"); 
    echo '<main>';
  ?>
  <section id="account">
    <h1>YOUR ACME JOURNEY CONTINUES HERE</h1>
    <div id="your-account">
     <p class="account-blurb">This is your control center — where past plots live on and new ones begin. Browse your order history, brainstorm your next big idea, and remember: no genius ever played it safe. Whatever you're building, ACME's got your back. And if things go sideways (again), don't worry — we've seen worse. Probably.</p>
    </div>
    
    <?php 
        include_once("includes/order-summary.php");
        $orders = getUserOrders($_SESSION['uid']);
        foreach ($orders as $oid => $date) {
          printOrderSummary($oid);  
        }
      ?>

  </section>
  <?php
    echo '</main>';
  ?>

  


  
  <footer></footer>

  
</body>
</html>