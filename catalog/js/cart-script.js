async function removeItemFromCart(id) {
  // update session variable
  await fetch('includes/delete-cart-item-in-session.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: id, qty: 0 })
  });

  let qtyChg = -1 * parseInt(document.getElementById("qty-count-" + id).innerText);

  updateCartPage(id, 0, qtyChg);
}

function updateCartItemQty(up, id) {
  // update session variable
  fetch('includes/update-cart-qty-in-session.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: id, up: up })
  });

  let qty = parseInt(document.getElementById("qty-count-" + id).innerText);
  let newQty = qty;
  let qtyChg = 0;

  // update qty as needed
  if (up) {
    newQty++;
    qtyChg++;
    updateCartPage(id, newQty, qtyChg);
  }
  else if (qty > 1) {
    newQty--;
    qtyChg--;
    updateCartPage(id, newQty, qtyChg);
  }
  else if (qty == 1) {
    removeItemFromCart(id);
  }
}

function updateCartPage(id, newQty, qtyChg) {
  let cartItemDiv = document.getElementById("cart-item-" + id);
  let qtyDiv = document.getElementById("qty-count-" + id);
  let cartDiscountAmtDiv = document.getElementById("discount-amt");
  let itemPriceDiv = document.getElementById("cart-item-price-each-" + id);
  let itemTotalDiv = document.getElementById("cart-item-price-total-" + id);
  let cartSubtotalDiv = document.getElementById("cart-subtotal");
  let cartDiscountDiv = document.getElementById("cart-discount");
  let cartDeliveryDiv = document.getElementById("cart-delivery");
  let cartTaxDiv = document.getElementById("cart-tax");
  let cartTotalDiv = document.getElementById("cart-total");
  let freeShipCarrot = document.getElementById("free-shipping-carrot");

  // get subtotal to see if page should be reloaded (subtotal = 0) 
  let subtotal = qtyChg * getNumFrom(itemPriceDiv.innerText) +
    getNumFrom(cartSubtotalDiv.innerText);

  // get discount to make the rest of the calcs easier
  let discount = 0;
  if (cartDiscountAmtDiv !== null)
    discount = subtotal * getNumFrom(cartDiscountAmtDiv.innerText) / 100;

  // do page refresh
  if (subtotal == 0)
    window.location.href = 'cart.php';
  // else update page
  else {
    // remove/update line item as needed
    if (newQty == 0) { cartItemDiv.remove(); }
    else {
      qtyDiv.innerText = newQty;
      itemTotalDiv.innerText = formatNicely(
        newQty * getNumFrom(itemPriceDiv.innerText)
      );
    }

    // update cart summary fields
    cartSubtotalDiv.innerText = formatNicely(subtotal);
    cartDiscountDiv.innerText = formatNicely(discount);
    cartDeliveryDiv.innerText = formatNicely(getCartShipping(subtotal - discount));
    cartTaxDiv.innerText = formatNicely(getCartTax(subtotal - discount));
    cartTotalDiv.innerText = formatNicely(getCartTotal(subtotal - discount));

    // free shipping carrot
    if (subtotal - discount < 999) {
      freeShipCarrot.innerHTML = "You're only <span>$" +
        formatNicely(999 - (subtotal - discount)) +
        "</span> away from free delivery!";
    }
    else { freeShipCarrot.innerText = "You're getting free delivery!"; }
  }
}

function getNumFrom(s) {
  return parseFloat(s.replace(/,/g, ''));
}

function formatNicely(n) {
  return n.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function getCartShipping(num) {
  if (num >= 999)
    return 0;
  else
    return Math.max(5.99, num * .05);
}

function getCartTax(num) {
  return num * .07;
}

function getCartTotal(num) {
  return num + getCartShipping(num) + getCartTax(num);
}