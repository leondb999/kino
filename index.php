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
  <?php include('./functions/slider-functions.php') ?>
  <?php include('./functions/database_config.php') ?>


  <!-- Connect to MySQL DB-->
  <?php
    //connect to 
    $result_all_films = mysqli_query($con, "Select * from kinoticketing.film");
    // SQL get Kinoprogramm erste 4 Filme in DB 
    $sql_4_films = "Select * from kinoticketing.film WHERE ID>15";
    $result_4_films = mysqli_query($con,  $sql_4_films);
  ?>

<header>
  <!-- Navigation -->
  <?php include('./functions/navbar.php') ?>
</header>                    	

  <main role="main" >
    <!-- Slider --> 
    <div id="top-film-carousel" class="carousel slide" data-ride="carousel"  data-interval ="1000" style="margin-top: 0px" >
        
        <!-- Navigations Striche -->
        <ol class="carousel-indicators">
            <?php echo make_slide_indicators($connect); ?>
        </ol>
        <!-- The Slides -->
        <div class="carousel-inner"><?php echo make_slides($connect); ?></div>

        <!-- Vor & Zurück Pfeile --> 
        <!-- Rechter- Pfeil -->
        <a class="carousel-control-prev" href="#top-film-carousel" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <!-- Linker Pfeil -->
        <a class="carousel-control-next" href="#top-film-carousel" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<!-- ################################################################################## --> 
    

    <!-- Film Cards with PHP -->
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
  </main>
  <!--
  <footer class="footer">
    <div class="container">
      <span class="text-muted">Place sticky footer content here.</span>
    </div>
  </footer>
  -->
  <footer class="text-muted py-3 bg-dark">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-1">Album example is © Bootstrap, but please download and customize it for yourself!</p>
    <p class="mb-1">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a href="/docs/5.0/getting-started/introduction/">getting started guide</a>.</p>
  </div>
  </footer>

</body>
</html>