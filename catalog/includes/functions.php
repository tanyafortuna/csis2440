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

  // Adds product/qty to cart session variable
  function addItemToSession($pid, $pqty) {
    $found = false;

    if (isset($_SESSION['cart'])) {
      foreach($_SESSION['cart'] as $id => $qty) {
        if ($id == $pid) { 
          $_SESSION['cart'][$id] += $pqty; 
          $found = true;
        }
      }
    }
    else $_SESSION['cart'] = array(); 
    
    if (!$found) { $_SESSION['cart'] += array($pid => (int) $pqty); }
  }

	// Process an order
	function processOrder($oid) {
		$date = date("n/j/y");
		$uid = $_SESSION['uid'];
    $promo = $_SESSION['discount_code'];

		addOrderToDB($oid, $date, $uid, $promo);

		foreach ($_SESSION['cart'] as $id => $qty) {
      addLineItemToDB($oid, $id, $qty);
    }

		unset($_SESSION['cart']);
		unset($_SESSION['discount_code']);
		unset($_SESSION['discount_amt']);
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

  function getCartDiscount() {
    if (isset($_SESSION['discount_code']))
      return getCartSubtotal() * $_SESSION['discount_amt'] / 100;
    else return 0;
  }

  function getCartShipping() {
    $total = getCartSubtotal() - getCartDiscount();
    if ($total >= 999)
      return 0;
    else {
      return max(5.99, $total * .05);
    }
  }

  function getCartTax() {
    $total = getCartSubtotal() - getCartDiscount();
    return $total * .07;
  }

  function getCartTotal() {
    return getCartSubtotal() - getCartDiscount() + getCartShipping() + getCartTax();
  }

  function getFreeShippingCarrot() {
    return 999 - (getCartSubtotal() - getCartDiscount());
  }

	// Order confirmation helper functions
	function getOrderSubtotal($oid) {
    $total = 0;
		$items = getOrderLineItems($oid);

    foreach ($items as $pid => $qty) {
      $product = getProductFromDB($pid);
      $total += $product['price'] * $qty;
    }

    return $total;
  }

  function getOrderDiscount($oid) {
    $discount = getDiscountForOrder($oid);
    // $discount = 0;
    return getOrderSubtotal($oid) * $discount / 100;
  }

	function getOrderShipping($oid) {
    $total = getOrderSubtotal($oid) - getOrderDiscount($oid);
    if ($total >= 999)
      return 0;
    else {
      return max(5.99, $total * .05);
    }
  }

  function getOrderTax($oid) {
    $total = getOrderSubtotal($oid) - getOrderDiscount($oid);
    return $total * .07;
  }

	function getOrderTotal($oid) {
    return getOrderSubtotal($oid) -
      getOrderDiscount($oid) + 
			getOrderShipping($oid) + 
			getOrderTax($oid);
  }
?>