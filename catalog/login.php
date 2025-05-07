<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <link rel="stylesheet" type="text/css" href="css/button.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <script src="js/script.js" defer></script>
  <title>ACME Corporation</title>
</head>
  <?php 
    include_once("includes/nav.php"); 
  ?>
  <main>
    <section id="login">
      <h1>WELCOME BACK, ACME INSIDER</h1>
      <p class="login-blurb">Sign in to place new orders, review past purchases, and stay one step ahead of the mayhem.</p> 
      <!-- save your favorite inventions, -->

      <div id="login-form">
        <form method="post">
          <div class="input">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="field">
            <p class="error-container" id="error-username"></p>
          </div>
          <div class="input">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="field">
            <p class="error-container" id="error-password"></p>
          </div>
          <div class="input">
            <input type="submit" id="submit" class="button" name="submit" value="SIGN IN">
          </div>
          <!-- <input type="hidden" name="num_tries" value="'.$num_tries.'"> -->
        </form>
      </div>

      <p class="login-blurb short">Need an account? <a href="create-account.php">Sign up now</a></p> 
    </section>
  </main>
  

  


  
  <footer></footer>

  
</body>
</html>