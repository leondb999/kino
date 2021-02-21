<!DOCTYPE html>
<html>
  <head>
    <!-- Resrouces from https://getbootstrap.com/docs/4.4/getting-started/download/ -->
	<!-- Resrouces from https://getbootstrap.com/docs/4.4/getting-started/download/ -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"> </script> 
  <link rel="stylesheet" type="text/css" href="/css/result-light.css"> 
  <script type="text/javascript" src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"> </script> 
  <link rel="stylesheet"type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"> 
  <!--<link rel="stylesheet" type="text/css" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <Title >Kino</Title>


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
  <!-- Image Upload -->



    <div id="site-content">
      <header class="site-header">
        <!--<div class="container"> -->
          <!-- logo -->
          <!-- nav -->
          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">DHBW-Kino Mannheim</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Kinoprogramm</a></li>
                  <li><a href="#">Über uns</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Warenkorb</a></li>
                </ul>
              </div>
            </div>
          </nav>
  
         
        <!--</div> container -->
      </header>

      <div id="top-film-carousel" class="carousel slide " data-ride="carousel" data-interval ="2000">
              <div class="carousel-inner">
                <!-- 1. Slide --> 
                <div class="carousel-item active">
                  <!-- img-fluid -->
                  <img class="d-block w-100" src="./images/Herr-der-Ringe.jpg"alt="First slide">
                </div>
                <!-- 2. Slide --> 
             
                 <div class="carousel-item ">
                  <img class="d-block w-100" src="./images/Star-Wars-Battlefront.png"alt="First slide">
                </div>
              
                <!-- 3. Slide --> 
              <!--
                <div class="carousel-item "> 
                  <img class="d-block img-fluid" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_177b9b3eb79%20text%20%7B%20fill%3A%23555%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_177b9b3eb79%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22285.9140625%22%20y%3D%22217.7%22%3EFirst%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="First slide">
                </div>
              -->
              </div>
            </div>
      <!-- 
       
        images/Herr-der-Ringe.jpg
    -->
      <main class="main-content">
        <div class="container "> <!-- container-fluid--> 
        <!-- Slider / Carousel --> 
      
          <div class="row">
            <div id="top-film-carousel" class="carousel slide " data-ride="carousel" data-interval ="2000">
              <div class="carousel-inner">
                <!-- 1. Slide --> 
                <div class="carousel-item active">
                  <!-- img-fluid -->
                  <img class="d-block w-100" src="./images/Herr-der-Ringe.jpg"alt="First slide">
                </div>
                <!-- 2. Slide --> 
             
                 <div class="carousel-item ">
                  <img class="d-block w-100" src="./images/Star-Wars-Battlefront.png"alt="First slide">
                </div>
              
                <!-- 3. Slide --> 
              <!--
                <div class="carousel-item "> 
                  <img class="d-block img-fluid" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22800%22%20height%3D%22400%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20800%20400%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_177b9b3eb79%20text%20%7B%20fill%3A%23555%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A40pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_177b9b3eb79%22%3E%3Crect%20width%3D%22800%22%20height%3D%22400%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22285.9140625%22%20y%3D%22217.7%22%3EFirst%20slide%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="First slide">
                </div>
              -->
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
          <!--Table div -->
            <div class = "col-lg-12">
              <table class="table table-boardered table-lm table-dark">

                <thead>
                  <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                  </tr>
                </thead>

                <tbody>
                  <?php while( $film = mysqli_fetch_assoc($result) ) { ?> 
                      <tr> 
                        <td><?php echo $film ['ID']; ?></td>
                        <td><?php echo $film ['Name']; ?></td>
                      </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- Upload Image Div -->
          
          </div>


        </div>
      </main>
      <footer class="site-footer">

      </footer>
      <!--Container-->

    </div>
  </body>
</html>