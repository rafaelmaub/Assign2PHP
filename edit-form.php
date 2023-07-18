<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
<title>Grade Edit</title>
</head>
<body>

<?php 
session_start(); 
include 'inc/header.php';
unset($_SESSION["error"]);
require_once('inc/database.php');
if (isset($_GET['id'])) 
{
	$res = $database->read($_GET['id']);

	$entry = mysqli_fetch_assoc($res);
	$grade = $entry['grade'];
	$assign = $entry['assignment'];
	$firstname = $entry['student'];
	$image = $entry['image'];
}
?>

<main>
<h2>Edit student grade:</h2>
<form method="post" enctype='multipart/form-data'>

<label for="input1">Grade (%):</label>
<input type="number" name="grade"id="input1" min="0" max="100" step="0.1" value="<?php echo $grade;?>">
<br>
<label for="input2">Assignment Name:</label>
<input type="text" name="assignment"id="input2" value="<?php echo $assign;?>">
<br>
<label for="input3">Student First Name:</label>
<input type="text" name="student" id="input3" value="<?php echo $firstname;?>">
<br>
<label for="input4">Alter Student Photo:</label>
<input type="file" name='files[]' id="input4" accept="image/png, image/jpeg">
<br>

<style>
.delete-icon
{
    width: 70%;
}
.delete-btn
{
    display: inline-flex;
	padding: 0;
	width: 20%;
	justify-content: center;
	margin-top: 10%;
	margin-left: 40%;
}
</style>


<input type="submit" value="Submit">
<a href='delete.php?id=<?php echo $_GET["id"]?>' class="delete-btn"> <img src='./img/delete-icon.svg' class="delete-icon"> </a>
</form>
<div class="submit-message">
<?php
	require_once('inc/database.php');
	if(isset($_POST) & !empty($_POST))
	{
		$grade = $_POST['grade'];
		$assignment = $_POST['assignment'];
		$student = $_POST['student'];

		$fileAddress = $image;
		
		if(file_exists($_FILES['files']['tmp_name'][0]) && is_uploaded_file($_FILES['files']['tmp_name'][0]))
		{
			$filename = $_FILES['files']['name'][0];
			$fileAddress = './uploads/'.$filename;
			move_uploaded_file($_FILES['files']['tmp_name'][0], $fileAddress);
		}


		$res = $database->alterEntry($_GET['id'], $grade, $assignment, $student, $fileAddress);
		Header('location: index.php');
	}
?>
</div>
</main>

</body>
<?php include 'inc/footer.php';?>
</html>