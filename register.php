<?php
	// connection
	require './inc/database.php';
    $database->connect_db();


	// variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm = $_POST['confirm'];
	// validate inputs
	$ok = true;
	require './inc/header.php';
		if (empty($username)) 
        {
			echo '<p>Username required</p>';
			$ok = false;
		}
		if ((empty($password)) || ($password != $confirm)) 
        {
			echo '<p>Invalid passwords</p>';
			$ok = false;
		}
	// decide if we are saving or not
	if ($ok)
    {
		$password = hash('sha512', $password);
        
		// set up the sql
        $database->createAdmin($username, $password);

    	echo '<section class="success-row">';
		echo '<div>';
		echo '<h2>User Created</h2>';
		echo '</div>';
    	echo '</section>';
		//disconnect
	}
	?>

    <link rel="stylesheet" href="./css/login-style.css">

    <main>
	<section>

        <p>All setup, click the button below to head to the sign in page!</p>
        <a href="login.php">Sign In</a>

	</section>
    </main>

<?php require './inc/footer.php'; ?>
