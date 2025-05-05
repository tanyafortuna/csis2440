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

  function generateProductCard($id, $name, $price) {
    $output = "";

    $output .= '<a class="product-card" href="product.php?id='.$id.'">';
    $output .= '<div class="product-img">';
    $output .= '<img src="img/product-images/'.$id.'.jpg">';
    $output .= '</div>';
    $output .= '<div class="product-details">';
    $output .= '<p class="product-name">'.$name.'</p>';
    $output .= '<p class="product-price">$'.$price.'</p>';
    $output .= '</div>';
    $output .= '</a>';

    return $output;
  }

  ?>