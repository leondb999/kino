
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
    $name=$_POST['name'];
    $email=$_POST['email'];
    $sql="Insert INTO kinoticketing.seat_picking (name, email) VALUES ('$name', '$email')";
    if ($con->query($sql) === TRUE) {
        echo "data inserted: ".$name.", ".$email ;
    }
    else 
    {
      echo  "Error: " . $sql . "<br>" . mysqli_error($con);
    }
      

    ?>

