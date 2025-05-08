<?php
  echo '<section id="trending">';
  echo '<h1>MORE TRENDING PRODUCTS</h1>';
  echo '<div id="trending-products">';
  echo generateProductCard(9, "Earthquake Pills", 699.99);
  echo generateProductCard(2, "Axle Grease", 13.99);
  echo generateProductCard(5, "Bird Seed", 9.99);
  echo generateProductCard(15, "Out-Board Motor", 999.99);
  echo '</div>';
  echo '<a id="shop-all" href="catalog.php">';
  echo '<h1>SHOP ALL<img class="icon" src="img/icons/arrow-right.png"></h1>';
  echo '</a>';
  echo '</section>';
?>