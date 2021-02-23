



<!DOCTYPE html>
<html>
<head>

<title>PHP Login with Remember me script</title>

<!--<link rel ="stylesheet"type="text/css" href="../register/register-tutorial-2/style.css"> -->

</head>
<body>

<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "kinoticketing";  
session_start();

$con = mysqli_connect($servername,$username,"",$db_name);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  } 
if ($con){
    echo "Connected successfully to ".$servername." with User: ".$username;
}
mysqli_set_charset($con,"utf8");
if(!$con)
{
	die(mysqli_error());
}


if(isset($_POST['submit']))
{
	if((isset($_POST['email']) && !empty($_POST['email']))  && (isset($_POST['password']) && !empty($_POST['password'])))
	{
		$email = trim($_POST['email']);
		$password = $_POST['password'];
		
		$md5Pass = md5($password);
		
		$qry = "select * where EMail = '".$email."' and Passwort = '".$md5Pass."'";
		$rs = mysqli_query($con, $qry);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 1)
		{
			$getRow = mysqli_fetch_assoc($rs);
			$forOneHour = time() + 3600;
			
			if(isset($_POST['remember_me']) && $_POST['remember_me'] == 1)
			{
				
				
				setcookie("wdb_email",$email,$forOneHour,"/");
				setcookie("wdb_password",$password,$forOneHour,"/");
				setcookie("wdb_remember_me",$_POST['remember_me'],$forOneHour,"/");
				
			}
			else
			{
				
				if(isset($_COOKIE['wdb_email']))
				{
					setcookie("wdb_email","",$forOneHour,"/");
				}
				
				if(isset($_COOKIE['wdb_password']))
				{
					setcookie("wdb_password","",$forOneHour,"/");
					
				}
				
				if(isset($_COOKIE['wdb_remember_me']))
				{
					setcookie("wdb_remember_me","",$forOneHour,"/");
				}
			}
			
					
			$_SESSION = $getRow;
			header("location:dashboard.php");
			exit;
			
			
		}
		else
		{
			$errorMsg = "Wrong email or password";
		}
		
	}
}

?>
<div class="wrapper">
	<h1>PHP Login With Remember Me</h1>
	<div class="form-wrapper">
		<?php 
			if(isset($errorMsg))
			{
				echo '<div class="error-msg">';
				echo $errorMsg;
				echo '</div>';
				unset($errorMsg);
			}
			
			
		?>
		
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<div>
				<input type="text" name="email" placeholder="Enter Email" required value="<?php echo (isset($_COOKIE['wdb_email'])?$_COOKIE['wdb_email']:'')?>">
			</div>
			<div>
				<input type="password" name="password" placeholder="Enter Password" required value="<?php echo (isset($_COOKIE['wdb_email'])?$_COOKIE['wdb_password']:'')?>">
			</div>
			<div>
				<input type="checkbox" name="remember_me" value="1" <?php echo (isset($_COOKIE['wdb_email'])?'checked':'')?>><label>Remember me</label>
			</div>
			<div>
				<input type="submit" name="submit" value="submit">
			</div>

		</form>
	</div>
</div>
</body>

</html>