
<header>
<h1>Grade System - Assign 2</h1>
<ul>
  <li><a href="index.php">View Grades</a></li>
  <li><a href="form.php">Enter Grades</a></li>
  <li>
    <?php 

    if(!isset($_SESSION['user_id']))
    {
      echo('<a href="login.php">LogIn</a>');
    }
    else
    {
      echo('<a href="logout.php">LogOut</a>');
    }
    ?>
  </li>
</ul>
</header>