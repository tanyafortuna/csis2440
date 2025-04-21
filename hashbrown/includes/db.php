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
    $p = hashIt($p, $u);

    // get connection
    $conn = connectToDB();

    // create command
    $sql = "SELECT * FROM secureusers WHERE username='$u' AND password='$p';";

    // run command
    $results = mysqli_query($conn, $sql);
    
    // check results
    if (mysqli_num_rows($results)) 
    {
      $arr = mysqli_fetch_array($results, MYSQLI_ASSOC);

      $_SESSION['granted'] = true;
      $_SESSION['un'] = ucfirst($u);
      $_SESSION['img'] = $arr['img'];
      $_SESSION['num_logins'] = $arr['num_logins'] + 1;

      $response = "authorized";

      // create and run another command 
      $sql = "UPDATE secureusers SET num_logins='".$_SESSION['num_logins']."' WHERE username='$u';";
      mysqli_query($conn, $sql);
    }
    else 
      $response = "not authorized";

    // close connection
    mysqli_close($conn);

    return $response;
  }

  function checkIfUsernameExists() {
    // user-entered values
    $u = ((isset($_POST['username']) ? $_POST['username'] : false));

    // get connection
    $conn = connectToDB();

    // create command
    $sql = "SELECT * FROM secureusers WHERE username='$u';";

    // run command
    $results = mysqli_query($conn, $sql);

    // close connection
    mysqli_close($conn);

    // check results
    return mysqli_num_rows($results) ? true : false;

  }

  function createAccount() 
  {
    // user-entered values
    $u = ((isset($_POST['username']) ? $_POST['username'] : false));
    $p = ((isset($_POST['password']) ? $_POST['password'] : false));
    $p = hashIt($p, $u);

    // get connection
    $conn = connectToDB();

    // create command
    $sql = "INSERT INTO secureusers (username, password, img, num_logins) VALUES ('$u', '$p', 'img/default.jpg', 0);";

    // run command
    $results = mysqli_query($conn, $sql);

    // close connection
    mysqli_close($conn);
  }

  function getListOfUsers() 
  {
    // user-entered values
    $u = ((isset($_POST['username']) ? $_POST['username'] : false));
    $p = ((isset($_POST['password']) ? $_POST['password'] : false));
    $p = hashIt($p, $u);

    // get connection
    $conn = connectToDB();

    // create command
    $sql = "SELECT * FROM secureusers;";

    // run command
    $results = mysqli_query($conn, $sql);

    // process results
    $table = "";
    while($row = $results->fetch_assoc())
    { 
      $table .= "<ul>";
      $table .= "<li><span>Username</span>: ".$row['username'];
      $table .= "<li><span>Password</span>: ".$row['password'];
      $table .= "<li><span>Img url</span>: ".$row['img'];
      $table .= "<li><span>Logins</span>: ".$row['num_logins'];
      $table .= "</ul>";
    }

    return $table;
  }
?>