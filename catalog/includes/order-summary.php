<?php

// Print an item
  function printOrderItem($pid, $qty) {
    $product = getProductFromDB($pid);

    echo '<div class="order-item">';

    echo '<div class="order-item-name">';
    echo '<p>'.$product['name'].'</p>';
    echo '</div>';

    echo '<div class="order-item-price-each">$';
    echo number_format($product['price'], 2);
    echo '</div>';

    echo '<div class="order-item-qty">';
    echo $qty;
    echo '</div>';

    echo '<div class="order-item-price-total">$';
    echo number_format($product['price'] * $qty, 2);
    echo '</div>';
    echo '</div>';
  }

  function printOrderSummary($oid) {
    echo '<div class="gapper common subsection"></div>';
    echo '<h2 class="common">ORDER #'.$oid.' - PLACED ';
    echo getOrderInfo($oid)['order_date']; 
    echo '</h1>';
    echo '<div id="order-summary" class="common subsection">';

    // Left side (items)
    echo '<div class="left-side">';
    echo '<div id="order-header">';
    echo '<p id="order-header-name">PRODUCT NAME</p>';
    echo '<p id="order-header-each">EACH</p>';
    echo '<p id="order-header-qty">QTY</p>';
    echo '<p id="order-header-total">TOTAL</p>';
    echo '</div>';
    
    $items = getOrderLineItems($oid);
    foreach ($items as $pid => $qty) { printOrderItem($pid, $qty); }
   
    echo '</div>';
    
    // Right side (summary)
    echo '<div class="right-side">';
    echo '<div id="summary-heading">ORDER SUMMARY</div>';
    
    echo '<div class="summary" id="summary-subtotal">';
    echo '<div class="summary-left">Subtotal</div>';
    echo '<div class="summary-right">$';
    echo '<span id="order-subtotal">';
    echo number_format(getOrderSubtotal($oid), 2);
    echo '</span>';
    echo '</div>';
    echo '</div>';
    
    echo '<div class="summary" id="summary-shipping">';
    echo '<div class="summary-left">Delivery</div>';
    echo '<div class="summary-right">$';
    echo '<span id="order-delivery">';
    echo number_format(getOrderShipping($oid), 2);
    echo '</span>';
    echo '</div>';
    echo '</div>';

    echo '<div class="summary" id="summary-discount">';
    echo '<div class="summary-left">Discount</div>';
    echo '<div class="summary-right">-$0.00</div>';
    echo '</div>';
    
    echo '<div class="summary" id="summary-tax">';
    echo '<div class="summary-left">Tax</div>';
    echo '<div class="summary-right">$';
    echo '<span id="order-tax">';
    echo number_format(getOrderTax($oid), 2);
    echo '</span>';
    echo '</div>';
    echo '</div>';

    echo '<div class="summary" id="summary-total">';
    echo '<div class="summary-left">Grand Total</div>';
    echo '<div class="summary-right">$';
    echo '<span id="order-total">';
    echo number_format(getOrderTotal($oid), 2);
    echo '</span>';
    echo '</div>';
    echo '</div>';
    
    echo '</div>';
    echo '</div>';
  }
?>