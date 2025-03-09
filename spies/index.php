<?php
  error_reporting(-1);
  ini_set( 'display_errors', 1 );

  // read FBI file and pre-create table rows
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

  // read spies file and pre-create table rows
  $spies = fopen('includes/spies.txt', 'r');
  $spies_contents = fread($spies, filesize('includes/spies.txt'));
  $spies_contents_array = explode('||>><<||', $spies_contents);
  $spies_table = '';

  foreach ($spies_contents_array as $item) {
    $item_split = explode(',', $item);

    $spies_table .= '<tr>';
    for ($i = 0; $i < 2; $i++) {
      $spies_table .= '<td>'.ucwords($item_split[$i]).'</td>';
    }
    $spies_table .= '</tr>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script> // script to dynamically show either FBI or spies data in table
    function showTable(which) {
      document.getElementById("table").classList.remove("hide");
      if (which == 0) 
        document.getElementById("output-table").innerHTML = <?php echo json_encode($fbi_table); ?>;
      else if (which == 1) 
        document.getElementById("output-table").innerHTML = <?php echo json_encode($spies_table); ?>;
    }
  </script>
  <title>Spies R Us</title>
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


<?php
  function checkIfValidAuth() {
    // Accepted values
    $validLogins = ['chuck' => 'roast', 'bob' => 'ross'];

    // User-entered values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check username and password
    if (array_key_exists($username, $validLogins) && $validLogins[$username] == $password) 
      return "authorized";
    else
      return "not authorized";
  }

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
              <input type="submit" id="submit" class="button">
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
        <div id="files">
          <p>Select a file to view:</p>
          <div>
            <button id="fbi" class="button" onclick="showTable(0);">FBI</button>
            <button id="spies" class="button" onclick="showTable(1);">Spies</button>
          </div>
        </div>
        <div id="output">
          <table id="table" class="hide">
            <thead>
              <tr>
                <th class="left">Agent</th>
                <th class="right">Code Name</th>
              </tr>
            </thead>
            <tbody id="output-table">
            </tbody>
          </table>
        </div>
      </section>
    ';
  }
?>

