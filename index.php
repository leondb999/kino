<!DOCTYPE html>
<html>
  <head>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <Title >Kinoticketing</Title>
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
        <div class="container">
          <!-- logo -->
          <!-- nav -->
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">
              <img src="/logo/Kino.svg" width="30" height="30" class="d-inline-block align-top" alt="">
              
            </a>
            <!-- aria-controls verwendet wenn etwas dass nur auf eine ID verweißt zusammengeklappt werden soll  --> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#kino-navbar" aria-controls="kino-navbar" aria-expanded="true" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="kino-navbar">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Film List <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Login </a>
                </li>

              </ul>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
          </nav>
         
        </div>
      </header>
      <main class="main-content">
        <div class="container">
          <div class="row">
          <!--Table div -->
            <div class = "col-sm-12">
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