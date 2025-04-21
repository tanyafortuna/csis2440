<?php 
  session_start();
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
    <title>Sessions Video</title>
  </head>
  <body>
    <header>
      <?php
        include_once('includes/nav.php');
      ?>
    </header>
    <main>
      <div class="video">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/9Rm8-Uxsbxc?si=RWjmnK38Vuj2lGBF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </main>
  </body>
</html>

