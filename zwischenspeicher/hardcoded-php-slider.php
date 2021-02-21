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

  <!-- Cards Section  with PHP -->
  <section class="py-2 m-10">
    <div class="container">
    <h1 class="display-4">Kinoprogramm</h1>
    <p class="lead">Take a look at our Kinoprogramm!</p>
      <div class="row">
        
      </div>
    </div>        
  </section>
  <div class="container">
          <div class="row">

            <div class = "col-lg-12">
              <table class="table table-boardered table-lm table-dark">

                <thead>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Image Path</th>

                  </tr>
                </thead>

                <tbody>
                  <?php while( $film = mysqli_fetch_assoc($result_all_films) ) { ?> 
                      <tr> 
                        <td><?php echo $film ['ID']; ?></td>
                        <td><?php echo $film ['Name']; ?></td>
                        <td><?php echo $film ['Image_Slider_Path']; ?></td>
                      </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- Upload Image Div -->
          
          </div>


        </div>
  
  
        <!-- Navigation -->
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

  <!-- Slider -->
  
    <!-- ------------------------------------------------------------- -->
    
    
    <!-- Film Cards Hard Coded-->

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
    <!-- Film Cards with PHP



  </body>
</html>