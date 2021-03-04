<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>

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
        <link rel="stylesheet" href="seatchart.css">

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
               
            <div id="map-container">test</div>


            <div class="right">
                <div id="cart-container"></div>
                <div id="legend-container"></div>
            </div>
            </div>
        </main>

    <footer class="py-3 bg-dark" style="color: grey">
        <?php include('./functions/footer.php') ?>
    </footer>

    </body>
  <script type="text/javascript" src="seatchart.js"></script>
  <script>
    console.log(document.getElementById("map-container"));
    var options = {
        // Reserved and disabled seats are indexed
        // from left to right by starting from 0.
        // Given the seatmap as a 2D array and an index [R, C]
        // the following values can obtained as follow:
        // I = columns * R + C
        map: {
            id: 'map-container',
            rows: 9,
            columns: 9,
            // e.g. Reserved Seat [Row: 1, Col: 2] = 7 * 1 + 2 = 9
            reserved: {
                seats: [1, 2, 3, 5, 6, 7, 9, 10, 11, 12, 14, 15, 16, 17, 18, 19, 20, 21],
            },
            disabled: {
                seats: [0, 8],
                rows: [4],
                columns: [4]
            }
        },
        types: [
            { type: "regular", backgroundColor: "#006c80", price: 10, selected: [23, 24] },
            { type: "reduced", backgroundColor: "#287233", price: 7.5, selected: [25, 26] }
        ],
        cart: {
            id: 'cart-container',
            width: 280,
            height: 250,
            currency: '£',
        },
        legend: {
            id: 'legend-container',
        },
        assets: {
            path: "./assets",
        }
    };

    var sc = new Seatchart(options);

    //https://jsc.mm-lamp.com/
</script>                  


</html>