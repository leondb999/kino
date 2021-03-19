<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title>Registrieren</title>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> 
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel ="stylesheet"type="text/css" href="style.css">    
  </head>
  
  <?php
    if(isset($_POST["submit"])){
      require("mysql.php");
      $stmt = $mysql->prepare("Select * FROM users WHERE Username = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0){
        //Username ist frei
        $stmt = $mysql->prepare("Select * FROM users WHERE EMail = :email"); //Username überprüfen
        $stmt->bindParam(":email", $_POST["email"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
          if($_POST["pw"] == $_POST["pw2"]){
            //User anlegen
            $stmt = $mysql->prepare("Insert INTO users (Username, Passwort, EMail) VALUES (:user, :pw, :email)");
            $stmt->bindParam(":user", $_POST["username"]);
            $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->bindParam(":email", $_POST["email"]);
            $stmt->execute();
            echo "Dein Account wurde angelegt";
          } else {
            echo "Die Passwörter stimmen nicht überein";
          }
        } else {
          echo "Email bereits vergeben";
        }
      } else {
        echo "Der Username ist bereits vergeben";
      }
    }
     ?>
  <body>
   
    <section class="py-2 m-10">
        <div class="container">
            <h1>Account erstellen</h1>
            <form action="register.php" method="post">
            
            <!--    <input type="text" name="username" placeholder="Username" required><br>-->
                <input type="text" name="email" placeholder="Email" required><br>
                <input type="password" name="pw" placeholder="Passwort" required><br>
                <input type="password" name="pw2" placeholder="Passwort wiederholen" required><br>
                <button type="submit" name="submit">Erstellen</button>
            </form>
            <br>
            <a href="login.php">Hast du bereits einen Account?</a>
        </div>
    </section> 

    <main role="main" style="padding-top: 60px; padding-bottom: 30px">
        <div class="container">        
            <div class="row">
                <div class="col-md-9 col-lg-8 mx-auto">
                <h3>Account erstellen</h3>

                <form action="register.php" method="post">
                    <!-- Username Input-->
                    <div class="form-label-group">
                        <input type="text" id="input_Username" name="username" class="form-control" placeholder="Username" required autofocus><br>                
                        <label for="input_Username">Username</label>
                    </div>
                    <div class="form-label-group">
                        <input type="text" id="input_Email" name="email" placeholder="Email" required><br>
                        <label for="input_Email">Username</label>
                    </div>
                    <!-- Password Input-->
                    <div class="form-label-group">                  
                        <input type="password"  name="pw" id="inputPassword" class="form-control" placeholder="Password" required>
                        <label for="inputPassword">Password</label>
                    </div>

                    <!-- Submit Button -->                  
                    <button name="submit" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Einloggen</button>
                    
                    <!--Register Navigation -->
                    <div class="text-center">               
                    <a href="register.php">Noch keinen Account?</a><br>
                    </div>                    
                </form>
                </div>
            </div>
        </div> <!-- Container -->
    </main>
    <footer class=" footer py-3 bg-dark" style="color: grey b;">
      <?php include('./functions/footer.php') ?>
    </footer>
  </body>
</html>