<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>February 5</title>
</head>
<body>
  <?php 
    echo "<h1>February 5th</h1>"; 

    $person = ["first"=>"beavis", "last"=>"jones"];
    foreach ($person as $a => $b) {
      echo "<h4>$a: $b</h4>";
    }
  ?>

  <form action="" method="get">
    <input type="text" name="first-thing">
    <input type="text" name="second-thing">
    <input type="submit">
  </form>
</body>
</html>