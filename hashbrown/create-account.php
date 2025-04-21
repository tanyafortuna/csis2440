<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');
  if (isGranted()) header('location: .');

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
    <title>Create your account</title>
  </head>
  <body>
    <header>
      <?php
        if (!isset($_POST['submit']))
          $creationResult = "fresh";
        else if ($_POST['username'] == "" || $_POST['password'] == "" || $_POST['password2'] == "")
          $creationResult = "missing fields";
        else if ($_POST['password'] != $_POST['password2'])
          $creationResult = "pw mismatch";
        else if (checkIfUsernameExists()) 
          $creationResult = "account exists";
        else 
        {
          createAccount();
          $creationResult = "success";
        }
      ?>
    </header>
    <main>
      <?php
        switch ($creationResult)
        {
          case "fresh":
            echo displayCreateAccount();
            break;
          case "missing fields":
            echo displayCreateAccount("mf");
            break;
          case "pw mismatch":
            echo displayCreateAccount("pw");
            break;
          case "account exists":
            echo displayCreateAccount("un");
            break;
          case "success":
            echo displayAccountCreated();
            break;
        }
      ?>
    </main>
  </body>
</html>


<?php // output-printing functions
  function displayCreateAccount($denied = "") {
    echo '
      <section id="create-account">
        <div class="header">
    ';

    if ($denied == "mf") echo '<h1>All fields are required.</h1>';
    else if ($denied == "pw") echo '<h1>Password mismatch. Try again.</h1>';
    else if ($denied == "un") echo '<h1>Account exists. Please log in.</h1>';
    else echo '<h1>Create your account</h1>';

    echo '
        </div>
        <div id="form">
          <form method="post">
            <div class="input">
              <label for="username">Username:</label>
              <input type="text" name="username" id="username" class="text"
    ';
    if (isset($_POST['submit'])) echo ' value="'.$_POST['username'].'"';
    echo '    >
            </div>
            <div class="input">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" class="text"
    ';
    if (isset($_POST['submit'])) echo ' value="'.$_POST['password'].'"';
    echo '    >
            </div>
            <div class="input">
              <label for="password2">Confirm password:</label>
              <input type="password" name="password2" id="password2" class="text"
    ';
    if (isset($_POST['submit'])) echo ' value="'.$_POST['password2'].'"';
    echo '    >
            </div>
            <div class="input">
              <input type="submit" id="submit" class="button" name="submit">
              <input type="reset" id="reset" class="button">
            </div>

            <div><p><a href=".">Log in</a></p></div>
          </form>
        </div>
      </section>
    ';
  }


  function displayAccountCreated() {
    echo '
      <section id="create-account">
        <div class="header">
    ';

    echo '<h1>Success!</h1>';

    echo '
        </div>
        <div id="form">
          <p>Your account has been created.</p>
          <p><a href=".">Log in</a></p>
        </div>
      </section>
    ';
  }
?>