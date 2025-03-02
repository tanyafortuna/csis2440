<?php
  $phone = $_POST['phone'];

  if (empty($phone))
    header('Location: index.php?error=1');
  elseif (!preg_match('/^\(\d{3}\)\d{3}\-\d{4}$/', $phone))
    header('Location: index.php?error=2&entered='.$phone);
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
    </div>
    <div id="summary">
      <p>That was valid!</p>
      <p>You did it!</p>
      <p>Thanks for training today.</p>
      <p>You entered:</p>
      <p><?php echo $phone; ?></p>
    </div>

  </main>
</body>
</html>
