<?php 
  session_start();
  include_once('includes/functions.php');
  if (!isGranted()) header('location: .');

  if (isset($_POST['logout'])) 
  {
    session_destroy();
    header('location: .');
  }

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
    <title>Your Session</title>
  </head>
  <body>
    <header>
      <?php
        include_once('includes/nav.php');
      ?>
    </header>
    <main>
      <div class="account">
        <div>Greetings, Agent <?php echo $_SESSION['un']; ?>.</div>
        <img id="picture" src="<?php echo $_SESSION['img']; ?>">
        <form method="post">
          <input type="submit" id="logout" class="button" name="logout" value="Logout">
        </form>
      </div>
    </main>
  </body>
</html>


