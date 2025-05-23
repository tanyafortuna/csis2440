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
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <link rel="stylesheet" type="text/css" href="css/ads.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/product-card.css">
  <title>ACME Corporation</title>
</head>
<body>
  <?php 
    include_once("includes/product-card.php");
    include_once("includes/nav.php"); 
    echo '<main>';
    include_once("includes/index/banner.php");
    include_once("includes/index/reasons.php");
    include_once("includes/index/highlighted.php");
    include_once("includes/index/trending.php");
    include_once("includes/ads.php");
    echo '</main>';
    include_once("includes/footer.php"); 
  ?>
</body>
</html>