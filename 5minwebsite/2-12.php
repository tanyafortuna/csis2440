<?php
  $submitted = !empty($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>February 12th</title>
</head>
<body>
  <h1>February 12th</h1>
  <form method="post" <?php if ($submitted) echo 'style="opacity: 0;"'; ?> >
    <input type="text" name="thing1">
    <input type="text" name="thing2">
    <input type="submit">
  </form>
  <div>
    <?php
      if ($submitted)
      {
        echo '<p>'.$_POST['thing1'].'</p>';
        echo '<p>'.$_POST['thing2'].'</p>';
      }
    ?>
  </div>
</body>
</html>

