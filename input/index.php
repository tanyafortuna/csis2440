<?php
  $submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Party time!</title>
</head>
<body>
  <main>
    <div>
      <?php
        if (!$submitted)
          echo '<h1>RSVP for my party!</h1>';
        else
          echo '<h1>Thanks for RSVPing!</h1>';
      ?>    
    </div>
    <div id="form" <?php if($submitted) echo 'class="hide"'; ?>>
      <form method="post">
        <div class="input">
          <label for="firstname">First name:</label>
          <input type="text" name="firstname" id="firstname">
        </div>
        <div class="input">
          <label for="lastname">Last name:</label>
          <input type="text" name="lastname" id="lastname">
        </div>
        <div class="input">
          <label for="phone">Phone number:</label>
          <input type="tel" name="phone" id="phone">
        </div>
        <div class="input">
          <label for="email">Email address:</label>
          <input type="email" name="email" id="email">
        </div>
        <div class="input">
          <input type="submit" id="submit">
        </div>
      </form>
    </div>
    <div id="summary" <?php if(!$submitted) echo 'class="hide"'; ?>>
      <p>I'm excited for you to come!</p>
      <p>The information you gave was:</p>
      <?php
        if ($submitted)
        {
          echo '<div class="display-info">';
          echo '<p><span>First name:</span> '.$_POST['firstname'].'</p>';
          echo '<p><span>Last name:</span> '.$_POST['lastname'].'</p>';
          echo '<p><span>Phone number:</span> '.$_POST['phone'].'</p>';
          echo '<p><span>Email:</span> '.$_POST['email'].'</p>';
          echo '</div>';
        }
      ?>
    </div>
  </main>
</body>
</html>