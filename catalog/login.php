<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');
  if (isset($_POST['submit']) && !isValidAuth())
    $error = 'Invalid login. Please try again.';
  else
    $error = '';
  if (isGranted()) header('location: account.php');

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
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/nav.php"); 
  ?>
  <main>
    <section id="login">
      <h1>WELCOME BACK, ACME INSIDER</h1>
      <p class="login-blurb">Sign in to place new orders, review past purchases, and stay one step ahead of the mayhem.</p> 

      <div id="login-form">
        <form method="post">
          <div class="input">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="field" maxlength="20"
              <?php if (isset($_POST['submit'])) echo ' value="'.$_POST["username"].'"'; ?>
            >
            <img class="clear-icon" src="img/icons/clear.png" onclick="clearField('username');">
            <p class="error-container" id="error-username"></p>
          </div>
          <div class="input">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="field" maxlength="30"
              <?php if (isset($_POST['submit'])) echo ' value="'.$_POST["password"].'"'; ?>
            >
            <img class="clear-icon" src="img/icons/clear.png" onclick="clearField('password');">
            <p class="error-container" id="error-password">
              <?php echo $error; ?>
            </p>
          </div>
          <div class="input">
            <input type="submit" id="submit" class="button" name="submit" value="SIGN IN">
          </div>
        </form>
      </div>

      <p class="login-blurb short">Need an account? <a href="create-account.php">Sign up now</a></p> 
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>