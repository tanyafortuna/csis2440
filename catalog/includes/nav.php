<?php
  echo '<nav>';
  echo '<div id="nav-outer">';

  // Promo line
  echo '<div id="nav-promo">';
  echo '<div id="promo-reviews">';
  echo '<img class="icon" src="img/icons/star-full-white.png">';
  echo '<span>1000+ 5-STAR REVIEWS</span>';
  echo '<img class="icon" src="img/icons/star-full-white.png">';
  echo '</div>';
  echo '<div id="promo-shipping">';
  echo '<p>FREE SHIPPING ON ORDERS $999+</p>';
  echo '</div>';
  echo '</div>';
  
  // Logo line
  echo '<div id="nav-logo">';
  echo '<div class="blank-on-purpose"></div>';
  echo '<div id="nav-logo-img">';
  echo '<a href="."><img src="img/logo-rct-tan.jpg"></a>';
  echo '</div>';
  echo '<div id="nav-icons">';
  if (!isGranted()) {
    // Login icon
    echo '<a href="login.php">';
    echo '<div id="login-icon" class="tooltip-container">';
    echo '<img class="icon" src="img/icons/logged-out.png">';
    echo '<span class="tooltip">Log in/Sign up</span>';
    echo '</div>';
    echo '</a>';
  }
  else {
    // Cart icon
    if (isset($_SESSION['cart']) && array_sum(array_column($_SESSION['cart'],'qty')) > 0) {
      echo '<a href="cart.php">';
      echo '<div id="cart-icon" class="tooltip-container">';
      echo '<img class="icon" src="img/icons/cart-full.png">';
      echo '<span class="tooltip">Cart</span>';
      echo '</div>';
      echo '</a>';
    }
    else {
      echo '<a href="cart.php">';
      echo '<div id="cart-icon" class="tooltip-container">';
      echo '<img class="icon" src="img/icons/cart.png">';
      echo '<span class="tooltip">Cart</span>';
      echo '</div>';
      echo '</a>';
    }
    // Account icon
    echo '<a href="account.php">';
    echo '<div id="account-icon" class="tooltip-container">';
    echo '<img class="icon" src="img/icons/logged-in.png">';
    echo '<span class="tooltip">Account</span>';
    echo '</div>';
    echo '</a>';
    // Logout icon
    echo '<a href="logout.php">';
    echo '<div id="logout-icon" class="tooltip-container">';
    echo '<img class="icon" src="img/icons/logout.png">';
    echo '<span class="tooltip">Log out</span>';
    echo '</div>';
    echo '</a>';
  }

  echo '</div>';
  echo '</div>';

  // Links line
  echo '<div id="nav-links">';
  echo '<a href="catalog.php">SHOP</a>';
  echo '<a href="new-arrivals.php">NEW ARRIVALS</a>';
  echo '<a href="about.php">ABOUT US</a>';
  echo '<a href="contact.php">CONTACT US</a>';
  echo '</div>';

  echo '</div>';
  echo '</nav>';
?>