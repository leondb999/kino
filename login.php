<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>

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

    <?php
    if(isset($_POST["submit"])){
      require("mysql.php");
      
      
      $stmt = $mysql->prepare("Select * From users  Where Username = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 1){
        //Username ist frei
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["Passwort"])){
          session_start();
          $_SESSION["username"] = $row["Username"];
         
          // --------  Cookie Set --------
          setcookie("username_cookie", $row["Username"]);
          //-----------------------------------------------
        // Navigate to secret Side
          header("Location: index.php");
        
          //-------------------
        } else {
          echo "Der Login ist fehlgeschlagen";
        }
      } else {
        echo "Der Login ist fehlgeschlagen";
      }
    }

     ?>

    <main role="main" style="padding-top: 40px; padding-bottom: 30px">
      <div class="container">
        <h1>Anmelden</h1>
        <form action="login.php" method="post">
          <input type="text" name="username" placeholder="Username" required><br>
          <input type="password" name="pw" placeholder="Passwort" required><br>
          <button type="submit" name="submit">Einloggen</button>
        </form>
        <br>
        <a href="register.php">Noch keinen Account?</a><br>
        <a href="passwordreset.php">Hast du dein Passwor vergessen?</a>
      </div>
    </main>
  </body>
</html>