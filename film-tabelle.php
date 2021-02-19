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