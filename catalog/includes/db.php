<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '1550');
    define('DB', 'acme');
  }
  else
  {
    define('HOST', 'csis2440-server.mysql.database.azure.com');
    define('USER', 'rklodefopz');
    define('PASS', 'chickenliver2!');
    define('DB', 'acme');
  }

  function connectToDB()
  {
    $conn = new mysqli(HOST, USER, PASS, DB);
    return $conn;
  }

  function isValidAuth() {
    // user-entered values
    $u = ((isset($_POST['username']) ? $_POST['username'] : false));
    $p = ((isset($_POST['password']) ? $_POST['password'] : false));
    $p = hashIt($p, $u);

    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ss", $u, $p);
    $statement->execute();

    // get results
    $results = $statement->get_result();
    
    // close connection
    $statement->close();
    $conn->close();

    // check results
    if (mysqli_num_rows($results)) {
      $_SESSION['granted'] = true;
      return true;
    }
    else 
      return false;
  }

  function checkIfUsernameExists() {
    // user-entered values
    $u = ((isset($_POST['username']) ? $_POST['username'] : false));

    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM users WHERE username = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $u);
    $statement->execute();
	
    // get results
	  $results = $statement->get_result();

    // close connection
    $statement->close();
	  $conn->close();

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

    // create and run command
    $sql = "INSERT INTO users (username, password) VALUES (?, ?);";
    $statement = $conn->prepare($sql);
		$statement->bind_param("ss", $u, $p);
		$statement->execute();

    // close connection
    $statement->close();
		$conn->close();

    // set session
    $_SESSION['granted'] = true;
  }

  ?>