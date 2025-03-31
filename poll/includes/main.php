<?php
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }

	$submitted = !empty($_POST);

	include_once('includes/db.php');
	include_once('includes/functions.php');

?>