<?php
	require_once('inc/database.php');
	$res = $database->read();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/login-style.css">
<title>Log In</title>
</head>
<body>
<?php include 'inc/header.php';?>
<main>
<section class="account-handler">
      <div>
        <h3>Create an admin account</h3>
        <form method="post" action="register.php">
        	<p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
        	<p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
        	<p><input class="form-control" name="confirm" type="password" placeholder="Confirm Password" required /></p>
          <input type="submit" name="submit" value="Register" />
        </form>
      </div>
      <div>
        <h3>Log In:</h3>
        <form method="post" action="./inc/validate.php">
        	<p><input class="form-control" name="username" type="text" placeholder="Username" required /></p>
        	<p><input class="form-control" name="password" type="password" placeholder="Password" required /></p>
          <input type="submit" value="Login" />
          <?php
          session_start();
          if(isset($_SESSION["error"]))
          {
            echo '<strong>';
            echo $_SESSION["error"];
            echo '</strong>';
          }
          ?>
        </form>
      </div>
    </section>
</main>
</body>
<?php include 'inc/footer.php';?>
</html>