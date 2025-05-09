<?php
  session_start();

  // get JSON data from the request
  header('Content-Type: application/json');
  $input = json_decode(file_get_contents('php://input'), true);

  // update quantity in cart session variable
  foreach($_SESSION['cart'] as $id => $qty) {
    if ($id == $input['id']) { 
      if ($input['up']) 
        $_SESSION['cart'][$id]++; 
      else if ($_SESSION['cart'][$id] > 1) 
        $_SESSION['cart'][$id]--; 

      break;
    }
  }
?>