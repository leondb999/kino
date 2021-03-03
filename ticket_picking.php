<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include ('./variables/connection_secrets.php') ?>
  <?php include('./variables/sql_querys.php') ?>
  <?php include('./functions/database_config.php') ?>

  <title>Tickets</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel ="stylesheet"type="text/css" href="style.css"> 
</head>
<body>

  

  <header>
    <?php include('./functions/navbar.php') ?>
  </header>
  <main role="main" style="padding-top: 40px; padding-bottom: 30px">
  <?php
    // get Film Data by url parameter 
        $url = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url); 
        parse_str($url_components['query'], $params);  
        $id_film = $params['ID'];
    
        mysqli_set_charset($con,"utf8");
        $sql_film_id = "Select * from kinoticketing.film where ID=".$id_film;
        $result_film_id= mysqli_query($con,  $sql_film_id);
        $film = mysqli_fetch_assoc($result_film_id);
    ?>
    <?php 
        // get Data from Person by Username that is stored in cookie
        include('./functions/get_user_data_cookie.php') 
        // returns userdata as user_cookie
    ?>
    <?php
        // Füge Daten Film_ID und User_ID in Tabelle user_schaut_film ein
        if(isset($_POST["add_Warenkorb"])){
            
            require("mysql.php");
            //film ID und Name
            $f_ID = $film['ID'];
            $f_Name = $film['Name'];
            // logged in User ID und Name
            $u_ID = $user_cookie['ID'];
            $u_Username =  $user_cookie['Username'];

            $sql_add_warenkorb = "Insert Into kinoticketing.user_schaut_film (Film_ID, User_ID, Film_Name, User_Name) VALUES('$f_ID', '$u_ID', '$f_Name', '$u_Username')";
            if (mysqli_query($con, $sql_add_warenkorb)) {
                $message = '<div class="alert alert-success" role="alert">Success</div>';
            } else {
                echo "Error: " . $sql_add_warenkorb . "<br>" . mysqli_error($con);
            }
           
            header("Location: ./film.php?ID=$f_ID");

            //header("Location: kinoprogramm.php");
        }
     ?>

  <div class="container">
    <h1 class="display-4">Ticketauswahl:</h1>
    <br>
    <form action="" method="post"> <!-- action ="ticket_picking.php" -->
        <button type="submit" name="add_Warenkorb">Add to Warenkorb</button>
    </form>
    <div>
        <?php echo "Film_ID: ".$film['ID'] ?>
        <?php echo "Film_Name: ".$film['Name'] ?>
        <br>
        <?php echo "User_ID: ".$user_cookie['ID'] ?>
        <?php echo "User_Name: ".$user_cookie['Username']; ?>
    </div>

    <!--
    <div class="row gx-5">
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-success text-center">A1</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-danger text-center">A2</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-warning text-center">A3</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">A4</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">A5</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">A6</div></a>
        </div>
    </div>
    <br>
    <div class="row gx-5">
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">B1</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">B2</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">B3</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">B4</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">B5</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">B6</div></a>
        </div>
    </div>
    <br>
    <div class="row gx-5">
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C1</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C2</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C3</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C4</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C5</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C6</div></a>
        </div>
    </div>
    <br>
    <div class="row gx-5">
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C1</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C2</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C3</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C4</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C5</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C6</div></a>
        </div>
    </div>
    <br>
    <div class="row gx-5">
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C1</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C2</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C3</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C4</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C5</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C6</div></a>
        </div>
    </div>
    <br>
    <div class="row gx-5">
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C1</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C2</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C3</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C4</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C5</div></a>
        </div>
        <div class="col-sm-2">
            <a href="#" style="color: black"><div class="p-3 border bg-light text-center">C6</div></a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
-->
  </main>

  <footer class="py-3 bg-dark" style="color: grey">
    <?php include('./functions/footer.php') ?>
  </footer>

</body>
</html>