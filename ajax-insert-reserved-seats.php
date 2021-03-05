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
        echo "Connected successfully to ".$servername." with User: ".$username."<br>";
    }

    $reserved_seats=$_POST['reserved_seats'];
    $sql="Insert INTO kinoticketing.seat_picking (reserved_seats) VALUES ('$reserved_seats')";
    if ($con->query($sql) === TRUE) {
        echo "data inserted: ".$reserved_seats;
    }
    else 
    {
      echo  "Error: " . $sql . "<br>" . mysqli_error($con);
    }
      

    ?>