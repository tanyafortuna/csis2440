<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/product-card.css">
  <script src="js/script.js" defer></script>
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/product-card.php");
    include_once("includes/nav.php"); 
    echo '<main>';
    include_once("includes/banner.php");
    include_once("includes/reasons.php");
    include_once("includes/highlighted.php");
    include_once("includes/trending.php");
    echo '</main>';
  ?>

  


  
  <footer></footer>

  
</body>
</html>