
<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "kinoticketing";  
    $con = mysqli_connect($servername, $username, $password);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
      } 
    if ($con){
        echo "Connected successfully to ".$servername." with User: ".$username;
    }
 
  

    ?>

