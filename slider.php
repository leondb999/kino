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
    // SQL get Kinoprogramm erste 4 Filme in DB 
      $sql_4_films = "Select * from kinoticketing.film ";
      $result_4_films = mysqli_query($con,  $sql_4_films);
    
    //SQL for sliders -----------------------------------------------------------------
    
      //SQL Mandalorian
      $sql_mandalorian =  "Select * from kinoticketing.film Where Name = 'The Mandalorian'";
      $result_mandalorian = mysqli_fetch_assoc(mysqli_query($con,  $sql_mandalorian));
     // echo "<br>".$result_mandalorian['Name']."<br>".$result_mandalorian['Image_Slider_Path'];

      //SQL Fluch der Karibik
      $sql_fluch_der_karibik =  "Select * from kinoticketing.film Where Name = 'Fluch der Karibik'";
      $result_fluch_der_karibik = mysqli_fetch_assoc(mysqli_query($con,  $sql_fluch_der_karibik));
      //echo "<br>".$result_fluch_der_karibik['Name']."<br>".$result_fluch_der_karibik['Image_Slider_Path'];


      //SQL Avengers Endgame
      $sql_avengers =  "Select * from kinoticketing.film Where Name = 'Avengers Endgame'";
      $result_avengers = mysqli_fetch_assoc(mysqli_query($con,  $sql_avengers));
      //echo "<br>".$result_avengers['Name']."<br>".$result_avengers['Image_Slider_Path'];

    // -----------------------------------------------------------------------------------
  ?>



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
      <div class="carousel-item active" style="background-image: url(<?php echo $result_mandalorian['Image_Slider_Path'] ?>)"> 
        <div class="carousel-caption ">
          <h2 class="display-4"><?php echo $result_mandalorian['Name'] ?></h2>
          <p class="lead"><?php echo $result_mandalorian['Short_Description'] ?></p>
        </div>
      </div>

      <!-- 2. Slide --> 
      <div class="carousel-item" style="background-image: url(<?php echo $result_avengers['Image_Slider_Path'] ?>)">
        <div class="carousel-caption ">
          <h2 class="display-4"><?php echo $result_avengers['Name'] ?></h2>
          <p class="lead"><?php echo $result_avengers['Short_Description'] ?></p>
        </div>
      </div>
      
      <!-- 3. Slide --> 
      <div class="carousel-item" style="background-image: url( <?php echo $result_fluch_der_karibik['Image_Slider_Path'] ?>)">
        <div class="carousel-caption ">
          <h2 class="display-4"><?php echo $result_fluch_der_karibik['Name'] ?></h2>
          <p class="lead"><?php echo $result_fluch_der_karibik['Short_Description'] ?></p>
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
  </html>