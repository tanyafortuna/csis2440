function clearField(id) {
  document.getElementById(id).value = "";
}

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

// Listeners for form fields on create account page
if (window.location.href.includes("create-account.php")) {
  var un = document.forms["create-account-form"].elements["username"];
  var pw = document.forms["create-account-form"].elements["password"];
  var pw2 = document.forms["create-account-form"].elements["password2"];
  var reg = new RegExp("^(?=.*\\d)[A-Za-z\\d]{8,}$");

  un.addEventListener('keyup', checkIfFormComplete);
  pw.addEventListener('keyup', checkIfFormComplete);
  pw2.addEventListener('keyup', checkIfFormComplete);
  pw.addEventListener('keyup', checkPassword);
  pw.addEventListener('keyup', checkPassword2);
  pw2.addEventListener('keyup', checkPassword2);
}

function checkIfFormComplete() {
  //Disable/enable button logic
  if (
    un.value != "" && pw.value != "" && pw2.value != "" &&
    pw.value == pw2.value && reg.test(pw.value)
  )
    document.getElementById("submit").removeAttribute("disabled");
  else
    document.getElementById("submit").setAttribute("disabled", "");
}

function checkPassword() {
  if (pw.value != "" && !reg.test(pw.value))
    document.getElementById("error-password").innerText = "Use 8+ characters with at least 1 number.";
  else
    document.getElementById("error-password").innerText = "";
}

function checkPassword2() {
  if (pw2.value != "" && pw.value != pw2.value)
    document.getElementById("error-password2").innerText = "Passwords do not match.";
  else
    document.getElementById("error-password2").innerText = "";
}
