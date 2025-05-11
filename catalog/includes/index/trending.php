<?php
  echo '<section id="trending" class="common">';
  echo '<h1 class="common">MORE TRENDING PRODUCTS</h1>';
  echo '<p class="common">These crowd-pleasers are flying off shelves — and cliffs. From explosive favorites to gravity-defying breakthroughs, these ACME hits are making a splash (and occasionally a crater). See what your fellow schemers can\'t get enough of.</p>';
  echo '<div id="trending-products" class="common subsection four-products">';
  echo generateProductCard(9);
  echo generateProductCard(2);
  echo generateProductCard(5);
  echo generateProductCard(15);
  echo '</div>';
  echo '</section>';
?>