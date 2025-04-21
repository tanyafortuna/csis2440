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
    <title>Hash Browns</title>
  </head>
  <body>
    <header>
      <?php
        if (isGranted()) $authResult = "authorized";
        else if (isset($_POST['submit']) && $_POST['num_tries'] == 3) $authResult = "locked";
        else if (isset($_POST['submit'])) $authResult = checkIfValidAuth();
        else $authResult = "fresh login";

        if (isGranted()) include_once('includes/nav.php'); 
      ?>
    </header>
    <main>
      <?php
        switch ($authResult)
        {
          case "fresh login":
            echo displayUserLogin();
            break;
          case "not authorized":
            echo displayUserLogin($_POST['num_tries'] + 1, true);
            break;
          case "locked":
            echo displayLockedOut();
            break;
          case "authorized":
            echo displayAccessGranted();
            break;
        }
      ?>
    </main>
  </body>
</html>


<?php // output-printing functions
  function displayUserLogin($num_tries = 1, $denied = false) {
    echo '
      <section id="login">
        <div class="header">
    ';

    if ($denied) echo '<h1>Access Denied</h1>';
    else echo '<h1>Authentication Required</h1>';

    echo '
        </div>
        <div id="form">
          <form method="post">
            <div class="input">
              <label for="username">Username:</label>
              <input type="text" name="username" id="username" class="text">
            </div>
            <div class="input">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" class="text">
            </div>
            <div class="input">
              <input type="submit" id="submit" class="button" name="submit">
              <input type="reset" id="reset" class="button">
            </div>
            
            <input type="hidden" name="num_tries" value="'.$num_tries.'">

            <div><p><a href="create-account.php">Create an account</a></p></div>
          </form>
        </div>
      </section>
    ';
  }

  function displayLockedOut() {
    echo '
      <section id="login">
        <div class="header">
    ';

    echo '<h1>Access Denied</h1>';

    echo '
        </div>
        <div id="locked">
          <p>You have had too many incorrect password attempts so your access has been locked for security.</p>
        </div>
      </section>
    ';
  }

  function displayAccessGranted() {
    echo '
      <section id="access">

        <div class="header">
          <h1>Access Granted</h1>
          <p>You have logged in '.$_SESSION['num_logins'].' time(s).</p>
        </div>
        <div id="output">
          <table id="table">
            <thead>
              <tr>
                <th class="left">Agent</th>
                <th class="right">Code Name</th>
              </tr>';

    echo createFBITable();
    
    echo '
            </thead>
            <tbody id="output-table">
            </tbody>
          </table>
        </div>
      </section>
    ';
  }

  // read FBI file and create table rows
  function createFBITable() {
    $fbi = fopen('includes/fbi.txt', 'r');
    $fbi_contents = fread($fbi, filesize('includes/fbi.txt'));
    $fbi_contents_array = explode('||>><<||', $fbi_contents);
    $fbi_table = '';

    foreach ($fbi_contents_array as $item) {
      $item_split = explode(',', $item);

      $fbi_table .= '<tr>';
      for ($i = 0; $i < 2; $i++) {
        $fbi_table .= '<td>';
        $fbi_table .= $item_split[$i] == "csm" ? strtoupper($item_split[$i]) : ucfirst($item_split[$i]);
        $fbi_table .= '</td>';
      }
      $fbi_table .= '</tr>';
    }

    return $fbi_table;
  }
?>

