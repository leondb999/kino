<!DOCTYPE html>
<html>
  <head>

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

  <link rel ="stylesheet"type="text/css" href="style.css">
    <Title >Kino</Title>
  </head>

  <body>

    <!-- Import Variables and SQL Querys-->
    <?php include ('./variables/connection_secrets.php') ?>
    <?php include('./variables/sql_querys.php') ?>

    <!-- Connect to MySQL DB-->
    <?php
  //ass
      //connect to 
      $con = mysqli_connect($servername, $username, $password);
      if (!$con) {
          die("Connection failed: " . mysqli_connect_error());
        } 
      if ($con){
          echo "Connected successfully to ".$servername." with User: ".$username;
      }

      $get_film = "Select * from kinoticketing.film";
      $result = mysqli_query($con, $get_film);

/*
      # Check if result greater then 0
      if (mysqli_num_rows($result) > 0){
        # Display all Rows form DB
        while($rowData = mysqli_fetch_assoc($result)){
          echo '<br>'.$rowData["ID"].", ".$rowData["Name"];
        }
      }
      */
      
    ?>
    <!-- Navigation -->

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="/kino/index.php"> DHBW-Kino Mannheim </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="#"> Kinoprogramm </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"> Über uns </a>
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

<!-- Slider -->
  <div id="top-film-carousel" class="carousel slide " data-ride="carousel" data-interval ="2000">
    <!-- Navigations Striche -->
    <ol class="carousel-indicators">
      <li data-target="#top-film-carousel" data-slide-to="0" class="active"></li>
      <li data-target="#top-film-carousel" data-slide-to="1"></li>
      <li data-target="#top-film-carousel" data-slide-to="2"></li>      
    </ol>
    
    <div class="carousel-inner" >

      <!-- 1. Slide --> 
      <div class="carousel-item active" style="background-image: url(./images/The-Mandalorian2.jpg)"> 
        <div class="carousel-caption ">
          <h2 class="display-4">The Mandalorian</h2>
          <p class="lead">This is the Story of Mando and Baby Yoda.</p>
        </div>
      </div>
      
      <!-- 2. Slide --> 
      <div class="carousel-item" style="background-image: url(./images/Avengers-Endgame.jpg)">
        <div class="carousel-caption ">
          <h2 class="display-4">Avengers Endgame</h2>
          <p class="lead">Follow the Avengers in the fight against Thanos.</p>
        </div>
      </div>
      
      <!-- 3. Slide --> 
      <div class="carousel-item" style="background-image: url(./images/Pirates-of-the-Carribbean.jpg)">
        <div class="carousel-caption ">
          <h2 class="display-4">Fluch der Karibik</h2>
          <p class="lead">Caption Jack Sparrow's new Adventure.</p>
        </div>
      </div>

    </div>
  
  <!-- Vor & Zurück Pfeile --> 
    <!-- Rechter- Pfeil -->
    <a class="carousel-control-prev"href="#top-film-carousel" role="button" data-slide="prev">
      <!-- Icon des rechten Pfeils -->
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    
    <!-- Linker Pfeil -->
    <a class="carousel-control-next" href="#top-film-carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
    <!-- ------------------------------------------------------------- -->
    
    
    <!-- Page Content -->
    <section class="py-2 m-10">
    <div class="container">
      <h1 class="display-4">Film Portfolio</h1>
      <p class="lead">The background images for the slider are set directly in the HTML using inline CSS. The images in this snippet are from <a href="https://unsplash.com">Unsplash</a>, taken by <a href="https://unsplash.com/@joannakosinska">Joanna Kosinska</a>!</p>
    </div>
    </section>



  </body>
</html>