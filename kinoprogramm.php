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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
  <script src="../../assets/js/vendor/popper.min.js"></script>
  <script src="../../dist/js/bootstrap.min.js"></script>
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
        //echo "Connected successfully to ".$servername." with User: ".$username;
    }
    //SQL to get all films
      mysqli_set_charset($con,"utf8");
      $result_all_films = mysqli_query($con, "Select * from kinoticketing.film");
      $sql_4_films = "Select * from kinoticketing.film ";
      $result_4_films = mysqli_query($con,  $sql_4_films);
  ?>

  <header>
    <!-- Navigation -->
    <?php include('./functions/navbar.php') ?>
  </header>
  
  <main class="container" role="main" style="padding-top: 56px;">
    <section class="py-2 m-10">
      <div class="container">
        <h1 class="display-4">Kinoprogramm</h1>
        <p class="lead"> Kinoprogramm!</p>
        <div class="row">
          <?php                    
            while($film = mysqli_fetch_array($result_4_films))
            {?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-0 shadow">
                <a href="./film.php?ID=<?php echo $film['ID'] ?>"><img src="<?php echo $film['Image_Slider_Path']?>" class="card-img-top" alt="First Card"></a>
                <div class="card-body text-center">
                  <h5 class="card-title mb-0"><a href="./film.php?ID=<?php echo $film['ID'] ?>">"<?php echo $film['Name']?>"</a></h5>
                  <div class="card-text text-black-50">"<?php echo $film['Short_Description']?>"</div>
                  </div>
                </div>
              </div>    
          <?php } ?>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer">
    <div class="container">
      <span class="text-muted">Place sticky footer content here.</span>
    </div>
  </footer>
</body>
</html>