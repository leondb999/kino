<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>

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
  <body>
      
  <header>
    <?php include('./functions/navbar.php') ?> 
  </header>    

  <?php
        // --- SQL Injection Schutz ---
      /* 
        Referenz: https://www.df.eu/blog/sql-injektionen-verhindern-in-php/
        Durch 'prepared Statements' werden benutzerdefinierte Daten vom Interpreter ferngehalten.
        Dabei übermitteln die parametrisierten Anweisungen den eigentlichen SQL-Befehl von den Parametern getrennt an die Datenbank
        Erst das DBMS selbst führt beide zusammen und maskiert dabei dei entscheidenden Sonderzeichen automatisch

        ---Erklärung prepared Statements:---
        Ein kompiliertes Query-Template mit Parameterplatzhalter werden durch (prepare) aufgerufen und an PHP-Variablen gebunden (bind)
        Durch (execute) werden die eigentlichen Abfragedaten zur Laufzeit übergeben.
        --> Struktur & Daten der Abfrage getrennt --> keine SQL Injection möglich
      */
    if(isset($_POST["submit"])){
      require("mysql.php"); // stellt eine DB-Verbindung durch PDO her
      
      $stmt = $mysql->prepare("Select * From users  Where Username = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount(); 
      
      if($count == 1){
        //Username wurde gefunden --> User ist registriert 
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["Passwort"])){ // password_verify() Überprüft, ob ein Passwort und ein Hash zusammenpassen
          session_start();
          $_SESSION["username"] = $row["Username"];         
          // --------  Cookie Set --------
          setcookie("username_cookie", $row["Username"]);
          
          // Navigiere zu der index Navigate to secret Side
          header("Location: index.php");//
          //-------------------
        } else {
          echo "Der Login ist fehlgeschlagen";
        }
      } else {
        echo "Der Login ist fehlgeschlagen";
      }
    }
  ?>

  <main role="main" style="padding-top: 60px; padding-bottom: 30px">
    <div class="container">
    
      <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">
          <h3>Login</h3>

          <form action="login.php" method="post">
            <!-- Username Input-->
            <div class="form-label-group">
              <input type="text" id="input_Username" name="username" class="form-control" placeholder="Username" required autofocus><br>                
              <label for="input_Username">Username</label>
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