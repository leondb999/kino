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
  <?php 
    // get Data from Person by Username that is stored in cookie
    include('./functions/get_user_data_cookie.php') 
    // returns userdata as user_cookie
  ?>
  <?php
    // Display all gekaufte Karten für die Filme, die zum Profil hinzugefügt wurden
    // get ID from logged in user
    $uID = $user_cookie['ID'];
    $name = $user_cookie['Username'];    
    $result_warenkorb_films= mysqli_query($con,  "Select * from kinoticketing.user_schaut_film Where User_Name = '$name'");
    $result_warenkorb_films_assoc = mysqli_fetch_assoc(mysqli_query($con,  "Select * from kinoticketing.user_schaut_film Where User_Name = '$name'"));        
  ?>

  <body>
    <header>
        <?php include('./functions/navbar.php') ?>
    </header>
    
    <main role="main" style="padding-top: 56px; padding-bottom: 30px">
    <section>
      <div class="container">
          <!-- <h3 class="display-4">User Profil</h3> -->
          <?php echo "<h1 > Hallo ".$_COOKIE['username_cookie']."</h1>";?>          
      </div>
    </section>

 
    <section class="py-2 m-10">
      <div class="container" style="padding-top: 20px">
        <h3 class="display-4">Gekaufte Karten</h3>
        <div class="row" style="padding-top: 20px">
          <?php foreach($result_warenkorb_films as $film): ?>
            <?php 
              // get Image            
              $film_id_img = $film['Film_ID'];
              $result_image_path= mysqli_query($con,  "Select * from kinoticketing.film Where ID = '$film_id_img'");
              $film_image = mysqli_fetch_assoc($result_image_path);
              while($film_image1 = mysqli_fetch_assoc($result_image_path)){
                echo "Image Path: ".$film_image1['Image_Slider_Path'] ;
              }                     
              ?>                
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-0 shadow">
                <a href="./film.php?ID=<?php echo $film['Film_ID'] ?>"><img class="card-img-top" src="<?php echo $film_image['Image_Slider_Path']?>"></a>
                <div class="card-body text-center">
                  <h5 class="card-title mb-0"><a href="./film.php?ID=<?php echo $film['Film_ID'] ?>"><?php echo $film['Film_Name']?></a></h5>

                  <div class="card-text text-black-50">Sitzplätze: <?php echo $film['Seat_Names']?></div>
                

                </div> 
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>


    </main>
    <footer class="py-3 bg-dark" style="color: grey">
      <?php include('./functions/footer.php') ?>
    </footer>
  </body>
</html>