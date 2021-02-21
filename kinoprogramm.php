<!DOCTYPE html>
<html>
<head>
  <title>Kinoprogramm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <?php include ('./variables/connection_secrets.php') ?>
  <?php include('./variables/sql_querys.php') ?>
  <?php include('./functions/slider-functions.php') ?>


  <?php

//connect to 
$con = mysqli_connect($servername, $username, $password);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
  } 
if ($con){
    echo "Connected successfully to ".$servername." with User: ".$username;
}
//SQL to get all films
  $result_all_films = mysqli_query($con, "Select * from kinoticketing.film");
  $sql_4_films = "Select * from kinoticketing.film ";
  $result_4_films = mysqli_query($con,  $sql_4_films);
?>

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

<br>

<section class="py-2 m-10">
        <div class="container">
            <h1 class="display-4">Kinoprogramm</h1>
            <p class="lead">Take a look at our Kinoprogramm!</p>
            <div class="row">
                <?php                    
                    while($film = mysqli_fetch_array($result_4_films))
                    {?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-0 shadow">
                                <img src="<?php echo $film['Image_Slider_Path']?>" class="card-img-top" alt="First Card">
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-0">"<?php echo $film['Name']?>"</h5>
                                    <div class="card-text text-black-50">"<?php echo $film['Short_Description']?>"</div>
                                </div>
                            </div>
                        </div>    
                <?php } ?>
            </div>
        </section>

</body>
</html>