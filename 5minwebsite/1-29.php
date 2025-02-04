<!DOCTYPE html>
<html lang="en">
<head>
  <title>January 29</title>
</head>
<body>
  <h1>January 29th</h1>
  <img src="img/chihuahua2.webp" width="300px">
  <ul>
    <?php
      goto cute;
      echo '<p>Hello</p>';

      cute:
      echo '<p>Cute dog!</p>';

      for ($i = 0; $i < 30; $i++)
        echo "<li>Bullet #".($i+1)."</li>";
    ?>
  </ul>
</body>
</html>