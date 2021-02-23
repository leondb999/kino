<?php include('../functions/database_config.php') ?>
<?php include ('../variables/connection_secrets.php') ?>
<?php

//$con=mysqli_connect("localhost","root","","project") or die("connection failed:".mysqli_error());

if(isset($_REQUEST['sub']))
{
$a = $_REQUEST['uname'];
$b = $_REQUEST['upassword'];

$res = mysqli_query($con,"select* from Kinoticketing.users where Firstname='$a'and Passwort='$b'");
$result=mysqli_fetch_array($res);
if($result)
{
	if(isset($_REQUEST["remember"]) && $_REQUEST["remember"]==1)
	setcookie("login","1",time()+10);// second on page time 
else
	setcookie("login","1");
	header("location:index-test.php");
	
	
}
else
{
	header("location:login.php?err=1");
	
}
}
?>