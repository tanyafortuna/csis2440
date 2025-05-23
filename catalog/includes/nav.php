<?php
  echo '<nav>';
  echo '<div id="nav-outer">';

  // Promo line
  echo '<div id="nav-promo">';
  echo '<div id="promo-reviews">';
  echo '<img class="icon" src="img/icons/star-full-white.png" alt="Star icon">';
  echo '<span>1000+ 5-STAR REVIEWS</span>';
  echo '<img class="icon" src="img/icons/star-full-white.png" alt="Star icon">';
  echo '</div>';
  echo '<div id="promo-shipping">';
  echo '<p>FREE SHIPPING ON ORDERS $999+</p>';
  echo '</div>';
  echo '</div>';
  
  // Logo line
  echo '<div id="nav-logo">';
  echo '<div class="blank-on-purpose"></div>';
  echo '<div id="nav-logo-img">';
  echo '<a href="."><img src="img/logo-rct-tan.jpg" alt="ACME logo"></a>';
  echo '</div>';
  echo '<div id="nav-icons">';
  if (!isGranted()) {
    // Login icon
    echo '<a href="login.php">';
    echo '<div id="login-icon" class="tooltip-container">';
    echo '<img class="icon" src="img/icons/logged-out.png" alt="Login icon">';
    echo '<span class="tooltip">Log in/Sign up</span>';
    echo '</div>';
    echo '</a>';
  }
  else {
    // Cart icon
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
      echo '<a href="cart.php">';
      echo '<div id="cart-icon" class="tooltip-container">';
      echo '<img class="icon" src="img/icons/cart-full.png" alt="Cart icon">';
      echo '<span class="tooltip">Cart</span>';
      echo '</div>';
      echo '</a>';
    }
    else {
      echo '<a href="cart.php">';
      echo '<div id="cart-icon" class="tooltip-container">';
      echo '<img class="icon" src="img/icons/cart.png" alt="Cart icon">';
      echo '<span class="tooltip">Cart</span>';
      echo '</div>';
      echo '</a>';
    }
    // Account icon
    echo '<a href="account.php">';
    echo '<div id="account-icon" class="tooltip-container">';
    echo '<img class="icon" src="img/icons/logged-in.png" alt="Account icon">';
    echo '<span class="tooltip">Account</span>';
    echo '</div>';
    echo '</a>';
    // Logout icon
    echo '<a href="logout.php">';
    echo '<div id="logout-icon" class="tooltip-container">';
    echo '<img class="icon" src="img/icons/logout.png" alt="Logout icon">';
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
  echo '<a id="faq-link" href="faq.php">FAQ</a>';
  echo '</div>';

  echo '</div>';
  echo '</nav>';
?>