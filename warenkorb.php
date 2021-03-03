<?php session_start(); ?>
<?php 
    // Nutzer muss eingeloggt sein, um auf den Warenkorb zuzugreifen
  if(!isset($_COOKIE["username_cookie"])){
    header("Location: login.php");
    exit;
  } 
?>
<!DOCTYPE html>
<html>
<head>
  <title>Warenkorb</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel ="stylesheet"type="text/css" href="style.css"> 
</head>
<body>

  <header>
    <?php include('./functions/navbar.php') ?>
  </header>

  <main role="main" style="padding-top: 60px; padding-bottom: 30px">
    <!-- DB connection -->
    <?php include('./functions/database_config.php') ?>

    <h1> Warenkorb </h1>
    <?php 
        // get Data from Person by Username that is stored in cookie
        include('./functions/get_user_data_cookie.php') 
        // returns userdata as user_cookie
    ?>
    <?php
        // Display all Films that were added to the Warenkorb

        // get ID from logged in user
        $uID = $user_cookie['ID'];
        $sql_warenkorb_films = "Select * from kinoticketing.user_schaut_film Where User_ID = $uID";
        $result_warenkorb_films= mysqli_query($con,  $sql_warenkorb_films);
        //$film = mysqli_fetch_assoc($result_warenkorb_films);
        while($film = mysqli_fetch_array($result_warenkorb_films)){
                echo $film['Film_ID'];
                echo ", ".$film['Film_Name'];
                echo ", ".$film['User_ID'];
                echo ", ".$film['User_Name']."<br>";
        }
    ?>


  </main>

  <footer class="py-3 bg-dark" style="color: grey">
    <?php include('./functions/footer.php') ?>
  </footer>

</body>
</html>