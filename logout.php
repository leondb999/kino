<?php
    session_start();
    //session_destroy();
    unset($_SESSION['username']);
    header("Location: index.php");
    //Lösche Cookie: Setze das Ablaufdatum in der Vergangenheit mit -3600
    setcookie('username_cookie', '',time() - 3600);
 ?>