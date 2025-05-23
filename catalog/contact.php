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
  <link rel="stylesheet" type="text/css" href="css/contact.css">
  <title>ACME Corporation</title>
</head>
<body>
  <?php include_once("includes/nav.php"); ?>

  <main>
    <section id="contact" class="common height">
      <h1 class="common padded">CONTACT US</h1>
      <div id="contact-us" class="common subsection">
        <div class="left-side">
          <p class="contact-blurb">
            Have a question, comment, or minor crater to report? We'd love to hear from you. Whether you're seeking product support, requesting a replacement spring-loaded boxing glove, or simply wondering what went wrong (again), the ACME team is here to help — more or less, depending on the fallout.
          </p>
          <p class="contact-blurb">
            You can reach us via carrier pigeon, smoke signal, or the standard contact methods. For urgent inquiries involving anvils, malfunctioning rocket skates, or misplaced portable holes, please allow 5-7 business days for our team to regroup and respond. Your satisfaction is important to us, just not technically guaranteed.
          </p>
        </div>
        <div class="right-side">
          <div class="right-side-icons">
            <img class="icon" id="mail-icon" src="img/icons/mail.png" alt="Main icon">
            <img class="icon" id="phone-icon" src="img/icons/phone.png" alt="Phone icon">
            <img class="icon" id="email-icon" src="img/icons/email.png" alt="Email icon">
          </div>
          <div class="right-side-text">
            <p class="contact-blurb">
              ACME Corporation Headquarters<br>1122 Cactus Loop Road<br>Tumbleweed Valley, NM 87001<br>United States
            </p>
            <p class="contact-blurb">1-800-HEY-ACME</p>
            <p class="contact-blurb">support@acmecorp.com</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include_once("includes/footer.php"); ?>
</body>
</html>