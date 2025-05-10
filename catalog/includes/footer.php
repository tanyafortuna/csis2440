<?php
  echo '<footer>';
  echo '<div id="footer-contents">';
  echo '<div>';
  echo '<h6>ABOUT ACME CORPORATION</h6>';
  echo '<p class="footer-blurb">ACME Corporation has been supplying inventors, dreamers, and the dangerously curious since 1935. ACME builds the tools that turn wild ideas into wilder outcomes. Our products are notoriously precision-engineereed for impact, speed, and questionable safety standards — because ordinary solutions just won\'t cut it. No disclaimers, no guarantees — just ACME gear, straight from the desert to you. Tread boldly, aim carefully, and keep a parachute handy.</p>';
  echo '</div>';
  echo '<div>';
  echo '<h6>SITE LINKS</h6>';
  echo '<p class="footer-blurb">';
  echo '<a href="about.php">About Us</a></p>';
  echo '<p class="footer-blurb">';
  echo '<a href="catalog.php">All Products</a></p>';
  echo '<p class="footer-blurb">';
  echo '<a href="new-arrivals.php">New Arrivals</a></p>';
 
  if (isGranted()) {
    echo '<p class="footer-blurb">';
    echo '<a href="cart.php">Cart</a></p>';
    echo '<p class="footer-blurb">';
    echo '<a href="account.php">Account</a></p>';
  }  

  echo '</div>';
  echo '<div>';
  echo '<h6>CONTACT US</h6>';
  echo '<p class="footer-blurb gap">ACME Corporation Headquarters<br>1122 Cactus Loop Road<br>Tumbleweed Valley, NM 87001 USA</p>';
  echo '<p class="footer-blurb gap">1-800-HEY-ACME</p>';
  echo '<p class="footer-blurb gap">support@acmecorp.com</p>';
  echo '</div>';
  echo '</div>';
  
  echo '<div>';
  echo '<p class="footer-blurb copyright"><span class="copyright-icon">©</span> 1935 - 2025 ACME Corporation. All Rights Reserved.</p>';
  echo '</div>';
  echo '</footer>';
?>