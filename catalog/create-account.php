<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');
  if (isGranted()) header('location: account.php');

  // error reporting
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }

  // set $acctExists and $acctCreated boolean variables
  if (!isset($_POST['submit'])) { 
    $acctExists = false; 
    $acctCreated = false;
  }
  else if (isset($_POST['submit']) && checkIfUsernameExists()) {
    $acctExists = true;
    $acctCreated = false;
  }
  else if (isset($_POST['submit']) && !checkIfUsernameExists()) {
    $acctExists = false;
    $acctCreated = true;
    createAccount();
    if (isset($_GET['pid'])) { 
      addItemtoSession($_GET['pid'], $_GET['qty']);
      header('location: cart.php');
    }
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
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script src="js/form-script.js" defer></script>
  <title>ACME Corporation</title>
</head>
<body>
  <?php include_once("includes/nav.php"); ?>
  
  <main>
    <section id="login" class="common height">
      <?php
        if ($acctCreated) { displaySuccess(); }
        else { displayForm($acctExists); }
      ?>
    </section>
  </main>
  
  <?php include_once("includes/footer.php"); ?>  
</body>
</html>


<!-- Output-printing functions -->
<?php
  function displaySuccess() {
    echo '<h1 class="common padded">WELCOME ABOARD, ACME INSIDER</h1>';
    echo '<p class="login-blurb">You\'re now part of the ACME family. Big plans? Odd gadgets? Everything you need is just a click away.</p>';
    include_once("includes/ads.php");
  }

  function displayForm($acctExists) {
    echo '<h1 class="common padded">INSIDER ACCESS STARTS HERE</h1>';
    if (!isset($_GET['pid'])) {
      echo '<p class="login-blurb">Create an account to quickly place orders and stay ready for whatever your next plan demands.</p>';
    }
    else {
      echo '<p class="login-blurb">Your next big idea is teetering on the edge — sign up and give it the final push into your cart.</p>';
    }

    echo '<div id="login-form">';
    if (isset($_GET['pid']))
      echo '<form id="create-account-form"method="post" action="create-account.php?pid='.$_GET['pid'].'&qty='.$_GET['qty'].'">';
    else
      echo '<form id="create-account-form" method="post">';

    // Username field
    echo '<div class="input">';
    echo '<label for="username">Username:</label>';
    echo '<input type="text" name="username" id="username" class="field" maxlength="20"';
    if (isset($_POST['submit'])) echo ' value="'.$_POST["username"].'"';
    echo '>';
    echo '<img class="clear-icon" src="img/icons/clear.png" onclick="clearField(\'username\');" alt="Clear icon">';
    echo '<p class="error-container" id="error-username">';
    if ($acctExists) echo 'Account already exists. Please log in.';
    echo '</p>';
    echo '</div>';
    // Password field 1
    echo '<div class="input">';
    echo '<label for="password">Password:</label>';
    echo '<input type="password" name="password" id="password" class="field" maxlength="30"';
    if (isset($_POST['submit'])) echo ' value="'.$_POST["password"].'"';
    echo '>';
    echo '<img class="clear-icon" src="img/icons/clear.png" onclick="clearField(\'password\');" alt="Clear icon">';
    echo '<p class="error-container" id="error-password"></p>';
    echo '</div>';
    // Password field 2
    echo '<div class="input">';
    echo '<label for="password2">Confirm password:</label>';
    echo '<input type="password" name="password2" id="password2" class="field" maxlength="30"';
    if (isset($_POST['submit'])) echo ' value="'.$_POST["password2"].'"';
    echo '>';
    echo '<img class="clear-icon" src="img/icons/clear.png" onclick="clearField(\'password2\');" alt="Clear icon">';
    echo '<p class="error-container" id="error-password2"></p>';
    echo '</div>';
    // Submit button
    echo '<div class="input">';
    echo '<input type="submit" id="submit" class="button" name="submit" value="SIGN UP" disabled>';
    echo '</div>';

    echo '</form>';
    echo '</div>';
    echo '<p class="login-blurb short">Have an account? ';
    if (isset($_GET['pid'])) 
      echo '<a href="login.php?pid='.$_GET['pid'].'&qty='.$_GET['qty'].'">';
    else 
      echo '<a href="login.php">';
    echo 'Sign in</a></p>';
  }
?>