<!DOCTYPE html>
<html>
  <head>
    <script src= "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js!"></script>
    <link rel="stylesheet" type="text/css" href=" https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src= "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
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