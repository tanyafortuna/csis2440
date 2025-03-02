<?php
  $error = $_GET['error'];
  $entered = $_GET['entered'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Phone number trainer</title>
</head>
<body>
  <main>
    <div class="header">
      <h1>Phone Number Trainer</h1> 
      <p>The format is critical.</p>
      <p>Practice makes perfect!</p>
    </div>
    <div id="form">
      <form method="post" action="process.php">
        <div class="input">
          <label for="phone">Phone number:</label>
          <input type="text" name="phone" id="phone" 
            <?php echo ' value="'.$entered.'"'; ?>
          >
        </div>
        <div class="input">
          <input type="submit" id="submit" class="button">
          <input type="reset" id="reset" class="button">
        </div>
        <div id="empty-error" 
          <?php if ($error != 1) echo ' class="hide"'; ?>
        >
          <p>The field was left blank.</p>
          <p>The correct format is:</p>
          <p>(123)456-7890</p>
        </div>
        <div id="invalid-error" 
          <?php if ($error != 2) echo ' class="hide"'; ?>
        >
          <p>Whoops, invalid format.</p>
          <p>The correct format is:</p>
          <p>(123)456-7890</p>
        </div>
      </form>
    </div>

  </main>
</body>
</html>