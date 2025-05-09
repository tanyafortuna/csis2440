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
  <link rel="stylesheet" type="text/css" href="css/about.css">
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/nav.php"); 
  ?>
  <main>
    <section id="about">
      <h1>IF IT'S ACME, IT'S A GASSER</h1>
      <div id="about-us">
        <div class="left-side">
          <img src="img/poster.webp">
        </div>
        <div class="right-side">
          <p class="about-blurb">
            Since 1935, ACME Corporation has proudly stood at the chaotic intersection of innovation, imagination, and questionable safety standards. With a legacy built on rocket skates, anvils, portable holes, and just enough legal ambiguity to keep things interesting, we've become the go-to supplier for animated professionals with big dreams and bigger explosions.
          </p>
          <p class="about-blurb">
            At ACME, we believe that every problem — no matter how cartoonishly complex — has a solution. Whether you're constructing an elaborate trap, launching a high-speed pursuit, or simply in need of a spring-loaded surprise, our expansive catalog offers tools for every scenario...and some that defy classification entirely.
          </p>
          <p class="about-blurb">
            Our commitment to quality is unmatched in the industry. Each product undergoes rigorous semi-controlled testing, often in the wild, and always with dramatic results. We're not just a brand — we're a legacy of animated ingenuity, trusted by coyotes, cats, ducks, and the occasional rabbit for nearly a century.
          </p>
          <p class="about-blurb">
            With operations based firmly (and occasionally precariously) in the heart of the American desert, ACME continues to push the limits of physics, reason, and good taste. We don't just think outside the box—we catapult out of it.
          </p>
          <p class="about-blurb">
            So whether you're a seasoned schemer or a first-time inventor, welcome to ACME. Browse boldly. Operate carefully. And remember: results may vary.
          </p>
        </div>
      </div>
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>