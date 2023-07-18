<?php
//store the user inputs in variables and hash the password
$username = $_POST['username'];
$password = hash('sha512', $_POST['password']);

//connect to db
require 'database.php';

$res = $database->readAdmin($username, $password);
$count = $res->num_rows;
session_start();
//check if any matches found
if ($count == 1)
{
	//echo 'Logged in Successfully.';
	foreach  ($res as $row)
	{
		//access the existing session created automatically by the server
		
		//take the user's id from the database and store it in a session variable
		$_SESSION['user_id'] = $row['user_id'];
		unset($_SESSION["error"]);
		//redirect the user
		Header('location: ../index.php');
	}
}
else 
{
	$error = "Username/Password incorrect";
	$_SESSION["error"] = $error;
	Header('location: ../login.php');
	
}

$conn = null;
?>