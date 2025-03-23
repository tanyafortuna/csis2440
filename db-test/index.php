<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }

	echo $_SERVER['HTTP_HOST'].'<br><br><br>';
	if ($_SERVER['HTTP_HOST'] == 'localhost')
	{
		define('HOST', 'localhost');
		define('USER', 'root');
		define('PASS', '1550');
		define('DB', 'palindromes');
	}
	else
	{
		define('HOST', 'csis2440-server.mysql.database.azure.com');
		define('USER', 'rklodefopz');
		define('PASS', 'chickenliver2!');
		define('DB', 'palindromes');
	}

	//CONNECT TO THE DATABASE
  $conn = mysqli_connect(HOST, USER, PASS, DB);
	
	//WRITE A DB QUERY
  $sql = 'SELECT * FROM palindrome;';
	
	//RUN DB QUERY 
	$results = mysqli_query($conn, $sql);

	//LOOP THROUGH THE DATA 
	while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{
		echo $row['phrase'].'<br>';
	};

?>