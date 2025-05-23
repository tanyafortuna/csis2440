<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');
  if (!isGranted()) header('location: .');

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
  <link rel="stylesheet" type="text/css" href="css/order-summary.css">
  <title>ACME Corporation</title>
</head>
<body>
  <?php include_once("includes/nav.php"); ?>

  <main>
  <section id="account" class="common height">
    <h1 class="common padded">YOUR ACME JOURNEY CONTINUES HERE</h1>
    <div id="your-account" class="common subsection">
     <p class="account-blurb common">This is your control center — where past plots live on and new ones begin. Browse your order history, brainstorm your next big idea, and remember: no genius ever played it safe. Whatever you're building, ACME's got your back. And if things go sideways (again), don't worry — we've seen worse. Probably.</p>
    </div>
    
    <?php 
        include_once("includes/order-summary.php");
        $orders = getUserOrders($_SESSION['uid']);
        foreach ($orders as $oid => $date) {
          printOrderSummary($oid);  
        }
      ?>
  </section>
  </main>

  <?php include_once("includes/footer.php"); ?>
</body>
</html>