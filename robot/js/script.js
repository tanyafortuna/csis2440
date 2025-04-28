function checkIfFormComplete() {
  console.log("->" + document.forms["robotform"]["robot-model"].value + "<-");
  console.log("->" + document.forms["robotform"]["robot-color"].value + "<-");
  console.log("->" + document.forms["robotform"]["robot-os"].value + "<-");
  console.log("->" + document.forms["robotform"]["robot-size"].value + "<-");
  console.log((
    document.forms["robotform"]["robot-model"].value != "" &&
    document.forms["robotform"]["robot-color"].value != "" &&
    document.forms["robotform"]["robot-os"].value != "" &&
    document.forms["robotform"]["robot-size"].value != ""
  ));

  if (
    document.forms["robotform"]["robot-model"].value != "" &&
    document.forms["robotform"]["robot-color"].value != "" &&
    document.forms["robotform"]["robot-os"].value != "" &&
    document.forms["robotform"]["robot-size"].value != ""
  )
    document.getElementById("submit").removeAttribute("disabled");
  else
    document.getElementById("submit").setAttribute("disabled", "");
}