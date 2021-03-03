<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit;
} else {
    echo "<a href='logout.php'>Abmelden</a>";
}
 ?>
 <?php 
  if(!isset($_COOKIE["username_cookie"])){
    header("Location: login.php");
    exit;
  } 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>

        <?php include('./functions/navbar.php') ?> 
    </header>                    	

    <h1>Top Secret</h1>
    <a href="logout.php">Abmelden</a>
  </body>
</html>