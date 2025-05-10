<?php
  // Returns true if user already has a logged-in session
	function isGranted()
	{
		if(isset($_SESSION['granted'])) return true;
		return false;
	}

  // Returns a hashed word, given a word and a username
	function hashIt($word, $user)
	{
		$s1 = "abcdefg";
		$s2 = "1234567";

		$u = hash('sha512', $s1.$user.$s2);

		return hash('sha512', $u.$word.$u);
	}

	// Process an order
	function processOrder($oid) {
		$date = date("n/j/y");
		$uid = $_SESSION['uid'];

		addOrderToDB($oid, $date, $uid);

		foreach ($_SESSION['cart'] as $id => $qty) {
      addLineItemToDB($oid, $id, $qty);
    }

		unset($_SESSION['cart']);
	}

	// Cart helper functions
	function getCartSubtotal() {
    $total = 0;

    foreach ($_SESSION['cart'] as $id => $qty) {
      $product = getProductFromDB($id);
      $total += $product['price'] * $qty;
    }

    return $total;
  }

  function getCartShipping() {
    $total = getCartSubtotal();
    if ($total >= 999)
      return 0;
    else {
      return max(5.99, $total * .05);
    }
  }

  function getCartTax() {
    $total = getCartSubtotal();
    return $total * .07;
  }

  function getCartTotal() {
    return getCartSubtotal() + getCartShipping() + getCartTax();
  }

  function getFreeShippingCarrot() {
    return 999 - getCartSubtotal();
  }
?>