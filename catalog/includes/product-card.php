<?php
  function generateProductCard($id) {
    $product = getProductFromDB($id);

    $output = "";

    $output .= '<a class="product-card" href="product.php?id='.$id.'">';
    $output .= '<div class="product-img">';
    $output .= '<img src="';
    $output .= $product['image'];
    $output .= '">';
    $output .= '</div>';
    $output .= '<div class="product-details">';
    $output .= '<p class="product-name">';
    $output .= $product['name'];
    $output .= '</p>';
    $output .= '<p class="product-price">$';
    $output .= number_format($product['price'], 2);
    $output .= '</p>';
    $output .= '</div>';
    $output .= '</a>';

    return $output;
  }
?>