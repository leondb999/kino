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

    // display film data with foreach-loop 
      $sql_first_three_films = "Select * from kinoticketing.film ";
      $result_first_three_films = mysqli_query($con,  $sql_first_three_films);
      $three_films = array();
      while($film = mysqli_fetch_array($result_first_three_films)){
        $three_films[] = $film;
      }
      foreach($three_films as $film ){
        echo "<br>".$film['Name']." ".$film['Image_Slider_Path'];
      }  
    //echo "<br>".$result_first_three_films['Name']."<br>".$result_first_three_films['Image_Slider_Path'];
    ?>

<div class="container">
          <div class="row">

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

          
  <!-- Cards Section  with PHP
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
             Upload Image Div 
          
          </div>


        </div>
  -->