<?php
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