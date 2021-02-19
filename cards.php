<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- leon -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <!-- nicolas navbar-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link rel ="stylesheet"type="text/css" href="style.css">
        <Title >Kino</Title>
    </head>
    <body>
 
        <?php include ('./variables/connection_secrets.php') ?>
        <?php include('./variables/sql_querys.php') ?>
        <h1>Hello </h1>
        
        <?php  
            $con = mysqli_connect($servername, $username, $password);
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            } 
            if ($con){
                echo "Connected successfully to ".$servername." with User: ".$username;
            }
            $sql_first_three_films = "Select * from kinoticketing.film ";
            $result_first_three_films = mysqli_query($con,  $sql_first_three_films);
        ?>

        <section class="py-2 m-10">
            <div class="container">
                <h1 class="display-4">Kinoprogramm</h1>
                <p class="lead">Take a look at our Kinoprogramm!</p>
                <div class="row">
                    <?php 
                        while($film = mysqli_fetch_array($result_first_three_films))
                        {?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div class="card border-0 shadow">
                                    <img src="<?php echo $film['Image_Slider_Path']?>" class="card-img-top" alt="First Card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title mb-0">"<?php echo $film['Name']?>"</h5>
                                        <div class="card-text text-black-50">"<?php echo $film['Short_Description']?>"</div>
                                    </div>
                                </div>
                            </div>      
                    <?php } ?>
                </div>
            </section>
                
    </body>
</html>