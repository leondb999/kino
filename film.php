<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- leon -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- nicolas navbar-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Nico's external resources for Film.php -->
   <!-- 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
-->
  <link rel ="stylesheet"type="text/css" href="style.css">


</head>
<body>

<?php include ('./variables/connection_secrets.php') ?>
<?php include('./variables/sql_querys.php') ?>
<?php include('./functions/slider-functions.php') ?>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="/kino/index.php"> DHBW-Kino Mannheim </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/kino/kinoprogramm.php"> Kinoprogramm </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/kino/about.php"> Über uns </a>
      </li>
    </ul>

    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-user"></i> Login </a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Warenkorb </a>
      </li>  
    </ul>
  </div>  
</nav>


<?php
  // get ID from URL
  //https://www.geeksforgeeks.org/how-to-get-parameters-from-a-url-string-in-php/#:~:text=The%20parameters%20from%20a%20URL,a%20URL%20by%20parsing%20it.
  $url = $_SERVER['REQUEST_URI'];
  $url_components = parse_url($url); 
  parse_str($url_components['query'], $params);  
  $id_film = $params['ID'];
  //echo "film ID:  ".$id_film."<br>";
  $con = mysqli_connect($servername, $username, $password);
  if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    } 
  if ($con){
      //echo "Connected successfully to ".$servername." with User: ".$username;
  }
  $result_all_films = mysqli_query($con, "Select * from kinoticketing.film");
  $sql_film_id = "Select * from kinoticketing.film where ID=".$id_film;
  $result_film_id= mysqli_query($con,  $sql_film_id);
  $film = mysqli_fetch_assoc($result_film_id);
?>



<br>

<div class="container">
  <div class="row">
  <div class="col-xl">
    <img src="<?php echo $film["Image_Slider_Path"] ?>" class="img-fluid" alt="Responsive image">
  </div>
  </div>
  <div class="row">
  <div class="col-xl">
    <br>
    <h2><?php echo $film["Name"] ?> </h2>
    <br>
    <p><?php echo $film["Long_Description"] ?></p>
  </div>
  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-xl">
        <h4> Filmdetails </h4>
        <br>
        <p>Hauptdarsteller: <?php echo $film["Hauptdarsteller"] ?></p>
        <p>Regisseur: <?php echo $film["Regisseur"] ?></p>
        <p>Altersfreigabe: <?php echo $film["FSK"] ?></p>
        <p>Dauer: <?php echo $film["Dauer"] ?> min</p>
        <p>Veröffentlichung: <?php echo $film["Jahr"] ?></p>
    </div>
    <div class="col-xl">
        <iframe class="responsive-iframe" width="700" height="395" src="<?php echo $film["Trailer"] ?>"></iframe>
    </div>
  </div>
</div>
<br>
<br>
</body>
</html>