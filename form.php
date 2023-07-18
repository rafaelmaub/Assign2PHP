<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
<title>Grade Entry</title>
</head>
<body>

<?php 
session_start(); 
include 'inc/header.php';
unset($_SESSION["error"]);
?>

<main>
<h2>Enter a student grade:</h2>
<form method="post" enctype='multipart/form-data'>

<label for="input1">Grade (%):</label>
<input type="number" name="grade"id="input1" min="0" max="100" step="0.1">
<br>
<label for="input2">Assignment Name:</label>
<input type="text" name="assignment"id="input2">
<br>
<label for="input3">Student First Name:</label>
<input type="text" name="student" id="input3">
<br>
<label for="input4">Student Photo:</label>
<input type="file" name='files[]' id="input4" accept="image/png, image/jpeg">
<br>
<input type="submit" value="Submit" name='submit'>
</form>
<div class="submit-message">
<?php
	require_once('inc/database.php');

	if(isset($_POST['submit']) & !empty($_POST['submit']))
	{
		$grade = $_POST['grade'];
		$assignment = $_POST['assignment'];
		$student = $_POST['student'];
		$fileAddress = './uploads/';
		$filename = $_FILES['files']['name'][0];
		$fileAddress = './uploads/'.$filename;
		move_uploaded_file($_FILES['files']['tmp_name'][0], $fileAddress);
		
		
		$res = $database->create($grade, $assignment, $student, $fileAddress);
		if($res)
		{
			echo "<p>Successfully inserted data</p>";
		}
		else
		{
			echo "<p>Failed to insert data</p>";
		}
	}
?>
</div>
</main>

</body>
<?php include 'inc/footer.php';?>
</html>