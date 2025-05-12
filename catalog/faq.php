<?php
  session_start();
  include_once('includes/db.php');
  include_once('includes/functions.php');

  // error reporting
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    error_reporting(-1);
    ini_set( 'display_errors', 1 );
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/faq.css">
  <script src="js/faq-script.js" defer></script>
  <title>ACME Corporation</title>
</head>
<body>
  <?php include_once("includes/nav.php"); ?>

  <main>
    <section id="faq" class="common height">
      <h1 class="common padded">FAQ</h1>
      <p class="common">
        Every brilliant invention sparks a few questions. Whether you're unsure about delivery times or detonation protocols, we've got you covered — more or less.
      </p>
      <div id="faq-content" class="common subsection">
        <div class="left-side">
          <h2 class="common">DELIVERY QUESTIONS</h2>

          <h3 id="q1" class="common accordion padded">How long does delivery take to canyon bottoms?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Faster than you can say “uh-oh.” We specialize in canyon-bottom logistics — and dramatic timing.</p>

          <h3 id="q2" class="common accordion padded">Is it normal for my order to arrive smoking?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Yes — a little smoke (or spark) on arrival is often a sign that your item is fully powered and ready for action.</p>

          <h3 id="q3" class="common accordion padded">What if my package arrives before I do?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">No problem — our gear's patient. Just grab it when you can, and maybe don't leave it near open flames or cliffs.</p>

          <h3 id="q4" class="common accordion padded">How do I track a delivery in mid-air?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Easy — look up, listen for whistling, and check for falling shadows. Mid-air tracking is more of an art than a science.</p>

          <h3 id="q5" class="common accordion padded">Are rocket-propelled deliveries available?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Absolutely, though timing and trajectory may vary and are not guaranteed. Stand back — and maybe wear goggles.</p>
        </div>

        <div class="right-side">
        <h2 class="common">PRODUCT QUESTIONS</h2>

          <h3 id="q6" class="common accordion padded">Do ACME gadgets come with a warranty?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Not in the traditional sense, but each ACME product is guaranteed to bring excitement to your life.</p>

          <h3 id="q7" class="common accordion padded">Can I return something if it explodes?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Explosions are part of the fun! Unfortunately, we don't offer returns for items that go out with a bang.</p>

          <h3 id="q8" class="common accordion padded">What should I know before using ACME gear?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Expect the unexpected! ACME gadgets are built for the brave, the curious, and those who dare to push the limits.</p>

          <h3 id="q9" class="common accordion padded">Are ACME devices tested on real roadrunners?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Our devices undergo rigorous trials to ensure maximum impact - but not on roadrunners. We'll leave that to you!</p>

          <h3 id="q10" class="common accordion padded">How do I know if a product is right for my plan?<img class="icon" src="img/icons/dropdown.png" alt="Dropdown icon"></h3>
          <p class="response">Full specs are on the product pages, but if you want to talk strategy (or an escape plan), contact our team of "experts".</p>
        </div>
      </div>
    </section>
  </main>

  <?php include_once("includes/footer.php"); ?>
</body>
</html>