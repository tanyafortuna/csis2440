<?php
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
    {
      $_SESSION['granted'] = true;
      $_SESSION['un'] = ucfirst($u);
      $_SESSION['img'] = mysqli_fetch_array($results, MYSQLI_ASSOC)['img'];
      return "authorized";
    }
    else 
      return "not authorized";
  }
?>