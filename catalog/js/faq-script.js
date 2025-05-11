// Listeners for questions clicked on FAQ page
if (window.location.href.includes("faq.php")) {
  for (let i = 1; i <= 10; i++) {
    document.getElementById("q" + i).addEventListener('click', toggleAnswer);
  }
}

function toggleAnswer() {
  this.classList.toggle("active");
  this.nextElementSibling.classList.toggle("show");
  this.firstElementChild.classList.toggle("flip");
}