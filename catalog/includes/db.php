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
    $result = $statement->get_result();
    
    // close connection
    $statement->close();
    $conn->close();

    // check results
    if (mysqli_num_rows($result)) {
      $_SESSION['granted'] = true;
      $_SESSION['uid'] = ($result->fetch_assoc())['id'];
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
	  $result = $statement->get_result();

    // close connection
    $statement->close();
	  $conn->close();

    // check results
    return mysqli_num_rows($result) ? true : false;
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

    // create and run command
    $sql = "SELECT * FROM users WHERE username = ?;";
    $statement = $conn->prepare($sql);
		$statement->bind_param("s", $u);
		$statement->execute();

    // get results
    $result = $statement->get_result();

    // close connection
    $statement->close();
		$conn->close();

    // set session
    $_SESSION['granted'] = true;
    $_SESSION['uid'] = ($result->fetch_assoc())['id'];
  }

  function getProductFromDB($id) {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM products WHERE id = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $id);
    $statement->execute();

    // get result
    $result = $statement->get_result();

    // close connection
    $statement->close();
    $conn->close();

    // return result
    return $result->fetch_assoc();
  }

  function getLargestOrderNum() {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT 1;";
    $statement = $conn->prepare($sql);
    $statement->execute();

    // get result
    $result = $statement->get_result();

    // close connection
    $statement->close();
    $conn->close();

    // return result
    if (mysqli_num_rows($result)) return ($result->fetch_assoc())['id'];
    else return 1947;
  }

  function addOrderToDB($oid, $date, $uid, $promo) {
    // get connection
    $conn = connectToDB();

    // create and run command
    if (!isset($_SESSION['discount_code'])) {
      $sql = "INSERT INTO orders (id, order_date, user_id) VALUES (?, ?, ?);";
      $statement = $conn->prepare($sql);
      $statement->bind_param("isi", $oid, $date, $uid);
    }
    else {
      $sql = "INSERT INTO orders (id, order_date, user_id, promo_code) VALUES (?, ?, ?, ?);";
      $statement = $conn->prepare($sql);
      $statement->bind_param("isis", $oid, $date, $uid, $promo);
    }
    $statement->execute();

    // close connection
    $statement->close();
    $conn->close();
  }

  function addLineItemToDB($oid, $pid, $qty) {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "INSERT INTO order_items (order_id, product_id, qty) VALUES (?, ?, ?);";
    $statement = $conn->prepare($sql);
    $statement->bind_param("iii", $oid, $pid, $qty);
    $statement->execute();

    // close connection
    $statement->close();
    $conn->close();
  }

  function getOrderInfo($oid) {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM orders WHERE id = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $oid);
    $statement->execute();

    // get result
    $result = $statement->get_result();

    // close connection
    $statement->close();
    $conn->close();

    // return result
    return $result->fetch_assoc();
  }

  function getOrderLineItems($oid) {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM order_items WHERE order_id = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $oid);
    $statement->execute();

    // get results
    $result = $statement->get_result();
    $results = array();
    while ($x = $result->fetch_assoc()) {
      $results += array($x['product_id'] => $x['qty']);
    }

    // close connection
    $statement->close();
    $conn->close();

    // return result
    return $results;
  }

  function getUserOrders($uid) {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $uid);
    $statement->execute();

    // get result
    $result = $statement->get_result();
    $results = array();
    while ($x = $result->fetch_assoc()) {
      $results += array($x['id'] => $x['order_date']);
    }

    // close connection
    $statement->close();
    $conn->close();

    // return result
    return $results;
  }

  function getPromoDiscount($code) {
    // get connection
    $conn = connectToDB();

    // create and run command
    $sql = "SELECT * FROM promo_codes WHERE name = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $code);
    $statement->execute();

    // get results
    $result = $statement->get_result();
    
    // close connection
    $statement->close();
    $conn->close();

    // check results
    if (mysqli_num_rows($result)) 
      $_SESSION['discount_code'] = $code;
      $_SESSION['discount_amt'] = intval(($result->fetch_assoc())['discount']);
  }

  function getDiscountForOrder($oid) {
    // get connection
    $conn = connectToDB();

    // create and run command (get promo code)
    $sql = "SELECT * FROM orders WHERE id = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("i", $oid);
    $statement->execute();

    // get result
    $result = $statement->get_result();
    $code = ($result ->fetch_assoc())['promo_code']; 
    if (is_null($code)) return 0; //no code was used

    // create and run command (get promo amount)
    $sql = "SELECT * FROM promo_codes WHERE name = ?;";
    $statement = $conn->prepare($sql);
    $statement->bind_param("s", $code);
    $statement->execute();

    // get result
    $result = $statement->get_result();
    $discount = ($result ->fetch_assoc())['discount'];

    // close connection
    $statement->close();
    $conn->close();

    // return result
    return $discount;
  }
  ?>