<?php
  session_start();

  // get JSON data from the request
  header('Content-Type: application/json');
  $input = json_decode(file_get_contents('php://input'), true);

  // remove from cart session variable
  foreach ($_SESSION['cart'] as $id => $qty) {
    if ($id == $input['id']) {
      unset($_SESSION['cart'][$id]); 
      break;
    }
  }
?>