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
    <title>Secret secure user list</title>
  </head>
  <body>
    <header>
      <?php
        include_once('includes/nav.php');
      ?>
    </header>
    <section class="users-list">
      <div class="users-list">
        <?php echo getListOfUsers(); ?>
      </div>
    </section>
  </body>
</html>


