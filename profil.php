<?php session_start(); ?>
<?php

// prüft, ob ein Cookie verfügbar ist, wenn das nicht der Fall ist wird man automatisch zur Login Page geleitet
if(!isset($_COOKIE["username_cookie"])){
  header("Location: login.php");
  exit;
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <Title >Profil</Title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel ="stylesheet"type="text/css" href="style.css"> 
    
  </head>
  <body>
    <header>
        <?php include('./functions/navbar.php') ?>
      </header>
    <main role="main" style="padding-top: 56px; padding-bottom: 30px">
      <?php include('./functions/database_config.php') ?>
      <?php 
        // get User Data
        // WICHTIG es müssen Cookies verfügbar sein!, Wenn der Benutzer sie zwischenzeitlich löscht funktioniert das ganze nicht mehr. Dann müsste man immer prüfen, ob ein Cookie verfügbar ist und wenns nicht verfügbar ist wird man automatisch zur login page umgeleitet
          $v = $_COOKIE['username_cookie'];
          $result_user_data = mysqli_query($con, "Select * from kinoticketing.users Where Username = '$v'");
          while($user = mysqli_fetch_array($result_user_data)){
            $email = $user['EMail'];
        }
      ?>

        <div class="container">
          <h1>User Profil </h1>
          <?php 
            echo "Hello ".$_COOKIE['username_cookie']; 
           
            echo $email;
          ?>
          
        </div>
    </main>
  </body>
</html>