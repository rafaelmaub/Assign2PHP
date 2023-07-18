<?php
	require_once('inc/database.php');
	$res = $database->read();
  session_start(); 

  unset($_COOKIE["user-modify"]);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="./css/style.css">
<title>Grade Visualizer</title>
</head>
<body>

<?php
include 'inc/header.php';
unset($_SESSION["error"]);
?>

<main>
<h2>All Grades:</h2>
<table class="table">
<colgroup>
  <col class="imageC">
  <col class="gradeC">
  <col class="assignC">
  <col class="studentC">

  <style>
  .editC
  {
      width: 100px;
  }
  col.imageC
  {
    width: 200px;
    max-height: 100px;
  }
  </style>
  <?php
  if(isset($_SESSION["user_id"]))
  {
    echo '<col class="editC">';
  }
  ?>
</colgroup>

<tbody>
<tr>
  <td>Student Pic:</td>
	<td>Grade (%):</td>
	<td>Assignment Title:</td>
	<td>Student Name:</td>

  <?php
  if(isset($_SESSION["user_id"]))
  {
    echo '<td>Edit:</td>';
  }
  ?>
</tr>

<?php

	while($r = mysqli_fetch_assoc($res))
    {?>   
        <tr>
        <td><img src=<?php echo $r['image'];?> class='imageUser'></td>
        <td><?php echo $r['grade']; ?></td>
        <td><?php echo $r['assignment']; ?></td>
        <td><?php echo $r['student'] ?></td>

        <style>
        .imageUser
        {
          width: 100%;
          height: 100%;
          max-width: 150px;
          max-height: 150px;
        }
        .echostyle
        {
          width: 20%;
          height: 20%;
        }
        .overrideA
        {
          padding: 0;
          padding-left: 2%;
          padding-top: 2%;
        }
        </style>

        <?php
        if(isset($_SESSION["user_id"]))
        {
          echo "<td><a href='edit-form.php?id=".$r['id']."' class = 'overrideA'><img src='./img/edit-icon.svg' class='echostyle'></a></td>";
        }
        ?>
        </tr>			
    <?php 
    }?>
    </tbody>

</table>
</main>
</body>
<?php include 'inc/footer.php';?>
</html>