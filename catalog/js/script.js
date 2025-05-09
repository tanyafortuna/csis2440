function updateCartItemQty(up, id) {
  // update session variable
  fetch('includes/update-session-cart.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: id, up: up })
  });

  // update page so a refresh isn't needed
  let qtyDiv = document.getElementById("qty-count-" + id);
  let qty = parseInt(qtyDiv.innerText);
  let newQty = qty;
  let qtyChg = 0;

  let itemPriceDiv = document.getElementById("cart-item-price-each-" + id);
  let itemTotalDiv = document.getElementById("cart-item-price-total-" + id);
  let cartSubtotalDiv = document.getElementById("cart-subtotal");
  let cartDeliveryDiv = document.getElementById("cart-delivery");
  let cartTaxDiv = document.getElementById("cart-tax");
  let cartTotalDiv = document.getElementById("cart-total");
  let freeShipCarrot = document.getElementById("free-shipping-carrot");

  // update qty as needed (not less than 1)
  if (up) {
    newQty++;
    qtyChg++;
  }
  else if (qty > 1) {
    newQty--;
    qtyChg--;
  }

  // update page 
  qtyDiv.innerText = newQty;
  itemTotalDiv.innerText = formatNicely(
    newQty * getNumFrom(itemPriceDiv.innerText)
  );

  let subtotal = formatNicely(
    qtyChg * getNumFrom(itemPriceDiv.innerText) +
    getNumFrom(cartSubtotalDiv.innerText)
  );
  cartSubtotalDiv.innerText = subtotal;

  cartDeliveryDiv.innerText = formatNicely(
    getCartShipping(getNumFrom(cartSubtotalDiv.innerText))
  );

  cartTaxDiv.innerText = formatNicely(
    getCartTax(getNumFrom(cartSubtotalDiv.innerText))
  );

  cartTotalDiv.innerText = formatNicely(
    getCartTotal(getNumFrom(cartSubtotalDiv.innerText))
  );

  if (subtotal < 999) {
    freeShipCarrot.innerHTML = "You're only <span>$" +
      formatNicely(999 - subtotal) +
      "</span> away from free delivery!";
  }
  else { freeShipCarrot.innerText = "You're getting free delivery!"; }

}

function getNumFrom(s) {
  return parseFloat(s.replace(/,/g, ''));
}

function formatNicely(n) {
  return n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function getCartTax(subtotal) {
  return subtotal * .07;
}

function getCartShipping(subtotal) {
  if (subtotal >= 999)
    return 0;
  else
    return Math.max(5.99, subtotal * .1);
}

function getCartTotal(subtotal) {
  return subtotal +
    getCartShipping(subtotal) +
    getCartTax(subtotal);
}