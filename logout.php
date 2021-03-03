<?php
session_start();
//session_destroy();
unset($_SESSION['username']);
header("Location: index.php");
// um ein Cookie zu löschen muss das Ablaufdatum in der vergangenheit setzen
setcookie('username_cookie', '',time() - 3600);
 ?>