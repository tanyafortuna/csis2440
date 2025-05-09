function updateProductPageQty(up) {
  let qtyDiv = document.getElementById("qty-count");
  let qty = parseInt(qtyDiv.innerText);
  let qtyInput = document.getElementById("product-qty");

  if (up) {
    qtyDiv.innerText = qty + 1;
    qtyInput.setAttribute('value', qty + 1);
  }
  else if (qty > 1) {
    qtyDiv.innerText = qty - 1;
    qtyInput.setAttribute('value', qty - 1);
  }
}