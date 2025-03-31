<?php include_once('includes/main.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Cheese poll</title>
  </head>
  <body>
    <main>
      <header>
        <?php 
          if ($submitted)
            echo '<h1>The votes are in!</h1>';
          else
            echo '<h1>Which is the best cheese?</h1>';
        ?>
      </header>
      <section id="poll">
        <form method="post" <?php if($submitted) echo 'class="hide"'; ?>>
          <div>
            <input type="radio" id="gouda" name="fav_cheese" value="gouda">
            <label for="gouda">Gouda</label>
          </div><div>
            <input type="radio" id="cheddar" name="fav_cheese" value="cheddar">
            <label for="cheddar">Cheddar</label>
          </div><div>
            <input type="radio" id="mozzarella" name="fav_cheese" value="mozzarella">
            <label for="mozzarella">Mozzarella</label>
          </div><div>
            <input type="radio" id="american" name="fav_cheese" value="american">
            <label for="american">American</label>
          </div><div>
            <input type="radio" id="brie" name="fav_cheese" value="brie">
            <label for="brie">Brie</label>
          </div>
          <div class="form-buttons">
            <input type="submit" id="submit">
            <input type="reset" id="reset">
          </div>
        </form>
        <div id="results" <?php if(!$submitted) echo 'class="hide"'; ?>>
          <?php 
            addToDB($_POST['fav_cheese']);
            echo printPollResults(); 
          ?>
        </div>
      </section>
    </main>   
  </body>
</html>

