<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>


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


    <h1>Anmelden</h1>
    <form action="login.php" method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="pw" placeholder="Passwort" required><br>
      <button type="submit" name="submit">Einloggen</button>
    </form>
    <br>
    <a href="register.php">Noch keinen Account?</a><br>
    <a href="passwordreset.php">Hast du dein Passwor vergessen?</a>
   
  </body>
</html>