<?php
require_once('inc/database.php');
if (isset($_GET['id'])) 
{
	$database->deleteEntry($_GET['id']);
}
Header('location: index.php');
?>