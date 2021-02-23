<?php 
session_start();

if(!isset($_SESSION['first_name']))
{
	header("location:index.php");
	exit;
}

if(isset($_GET['logout']) && $_GET['logout'] == true)
{
	session_destroy();
	
	header("location:index.php");
	exit;
}

echo "<strong>You are sussessfully login</strong>";

?>

<br	>
<a href="dashboard.php?logout=true">Logout</a>