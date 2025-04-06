<?php // error reporting and db functionality
  // error reporting
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }

  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '1550');
    define('DB', 'users');
  }
  else
  {
    define('HOST', 'csis2440-server.mysql.database.azure.com');
    define('USER', 'rklodefopz');
    define('PASS', 'chickenliver2!');
    define('DB', 'users');
  }

  function connectToDB()
	{
		$conn = mysqli_connect(HOST, USER, PASS, DB);
		return $conn;
	}

  function checkIfValidAuth() {
    if (isset($_POST['submit']))
    {
      // user-entered values
      $u = ((isset($_POST['username']) ? $_POST['username'] : false));
      $p = ((isset($_POST['password']) ? $_POST['password'] : false));

      // get connection
      $conn = connectToDB();

      // create command
      $sql = "SELECT * FROM user WHERE username='$u' AND password='$p';";

      // run command
      $results = mysqli_query($conn, $sql);

      // close connection
      mysqli_close($conn);

      // check results
      if (mysqli_num_rows($results)) 
        return "authorized";
      else 
        return "not authorized";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Totally Secure Spies R Us</title>
  </head>
  <body>
    <main>
      <?php
        if (isset($_POST['username'])) $authResult = checkIfValidAuth();
        else $authResult = "fresh login";

        switch ($authResult)
        {
          case "fresh login":
            echo displayUserLogin();
            break;
          case "not authorized":
            echo displayUserLogin(true);
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
  function displayUserLogin($denied = false) {
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
          </form>
        </div>
      </section>
    ';
  }

  function displayAccessGranted() {
    echo '
      <section id="access">
        <div class="header">
          <h1>Access Granted</h1>
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

