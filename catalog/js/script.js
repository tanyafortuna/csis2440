function clearField(id) {
  document.getElementById(id).value = "";
}

function updateProductPageQty(up) {
  qtyDiv = document.getElementById("qty-count");
  qty = parseInt(qtyDiv.innerText);
  if (up) qtyDiv.innerText = qty + 1;
  else if (qty > 1) qtyDiv.innerText = qty - 1;
}

// Listeners for form fields on create account page
let un = document.getElementById("username");
let pw = document.getElementById("password");
let pw2 = document.getElementById("password2");

// document.getElementById("username").addEventListener('keyup', checkIfFormComplete);
// document.getElementById("password").addEventListener('keyup', checkIfFormComplete);
// document.getElementById("password2").addEventListener('keyup', checkIfFormComplete);
// document.getElementById("password").addEventListener('blur', checkPassword);
// document.getElementById("password2").addEventListener('keyup', checkPassword2);
un.addEventListener('keyup', checkIfFormComplete);
pw.addEventListener('keyup', checkIfFormComplete);
pw2.addEventListener('keyup', checkIfFormComplete);
pw.addEventListener('blur', checkPassword);
pw.addEventListener('keyup', checkPassword2);
pw2.addEventListener('keyup', checkPassword2);
// let un = document.forms["create-account-form"]["username"];
// let pw = document.forms["create-account-form"]["password"];
// let pw2 = document.forms["create-account-form"]["password2"];
const reg = new RegExp("^(?=.*\\d)[A-Za-z\\d]{8,}$");

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
