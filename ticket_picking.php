<?php session_start(); ?>
<?php
// prüft, ob ein Cookie verfügbar ist, wenn das nicht der Fall ist wird man automatisch zur Login Page geleitet
if(!isset($_COOKIE["username_cookie"])){
  header("Location: login.php");
  exit;
} 
?>
<!DOCTYPE html>
<html>
    <head>

        <?php include('./functions/database_config.php') ?>

        <title>Tickets</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script> <!--integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"  crossorigin="anonymous"-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> <!-- integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" -->
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel ="stylesheet"type="text/css" href="style.css"> 
        <link rel="stylesheet" href="seatchart.css">
        <style>
            .content {
                display: flex;
                flex-direction: row;
                justify-content: center;
                margin-top: 40px;
            }

            .right {
                display: flex;
                flex-direction: column;
                margin-left: 80px;
            }

            #map-container {
                display: flex;
                align-items: center;
            }

            #legend-container {
                margin-top: 20px;
            }
        </style>
       
    </head>
    <body>
        <header>
            <?php include('./functions/navbar.php') ?>
        </header>
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
            
                //header("Location: ./film.php?ID=$f_ID");

                //header("Location: kinoprogramm.php");
                
            } 
        ?>
        <?php 
            // get reserved seats from db
            /// !!! hier könnte man mit AJAX 
            $f_ID_seat = $film['ID'];
            $result_user_data = mysqli_query($con, "Select reserved_seats From kinoticketing.seat_picking Where Film_ID = '$f_ID_seat'");
            while($r_seats = mysqli_fetch_array($result_user_data)){
                $r_seats_str = $r_seats['reserved_seats'];
            }
            $reserved_seats_db_arr = explode(',',$r_seats_str);
            
          // $reserved_seats_db_str = "1, 2, 3, 5,7";           
          // $reserved_seats_db_arr = explode(',',$reserved_seats_db_str);              
        ?>
       
        <main role="main" style="padding-top: 40px; padding-bottom: 30px"> 
            
            <h1 class="display-4">Ticketauswahl:</h1>
            <br>
            <form action="" method="post">  <!--action ="ticket_picking.php"  -->
                <button type="submit" name="add_Warenkorb">Add to Warenkorb</button>
            </form>
            <div>  
                             
                <?php echo "Film_ID: ".$film['ID'] ?>
                <?php echo "Film_Name: ".$film['Name'] ?>
                <br>
                <?php echo "User_ID: ".$user_cookie['ID'] ?>
                <?php echo "User_Name: ".$user_cookie['Username']; ?>         
            </div> 
            
        <div class="container">
            <p id="msg">Message: </p>
            <p id="all_seats_html"> </p>
            <div class="content">
                <div id="map-container"></div>
                <div class="right">
                    <div id="cart-container"></div>
                    <div id="legend-container"></div>
                       <!-- <form action="" method="post">  -->
                        <button type="submit" class="btn-primary" name= "seats_to_db" id="seats_to_db_id" >Push Seats to DB</button>
                       <!-- </form>-->
                        <button type="submit" class="btn-primary" name="get_selected_seats" onclick="getSelectedSeats()">Get Seats</button>                   
                    <div>
                        <h3>Bestellungs Data</h3>                        
                        <p id="selected-seats"></p>                        
                    </div>
                </div>
            </div>
        </div>


        <footer class="py-3 bg-dark" style="color: grey">
            <?php include('./functions/footer.php') ?>
        </footer>
        <script type="text/javascript" src="seatchart.js"></script>
        <script>
            
            // API Referenz des Seatpickers https://seatchart.js.org/api.html#Seatchart
            console.log(document.getElementById("map-container"));
            var js_array = [<?php echo '"'.implode('","',  $reserved_seats_db_arr ).'"' ?>];
            var options = {
                // Reserved and disabled seats are indexed
                // from left to right by starting from 0.
                // Given the seatmap as a 2D array and an index [R, C]
                // the following values can obtained as follow:
                // I = columns * R + C
                map: {
                    id: 'map-container',
                    rows: 8,
                    columns: 9,
                    // e.g. Reserved Seat [Row: 1, Col: 2] = 7 * 1 + 2 = 9
                    reserved: {
                        seats:js_array
                    },
                    disabled: {
                        seats: [0, 8],
                        rows: [4],
                        columns: [4]
                    }
                },
                types: [
                    // hier kann man die Preisklassen festlegen
                    // bei dem Typ darf kein Leerzeichen dazwischen sein 
                    { type: "regular", backgroundColor: "#006c80", price: 10 },//, selected: [23, 24] },
                    { type: "reduced", backgroundColor: "#287233", price: 7.5}, //, selected: [25, 26] }
                    
                    //{ type: "VIP", backgroundColor: "#FFA500", price: 20},
                ],
                cart: {
                    id: 'cart-container',
                    width: 280,
                    height: 250,
                    currency: '€',
                },
                legend: {
                    id: 'legend-container',
                },
                assets: {
                    path: "./assets",
                }
            };

            var sc = new Seatchart(options);
            
           
            console.log("hello", sc.getCart());
            //https://jsc.mm-lamp.com/

        </script>
        <!--<script type="text/javascript" src="seatpicker-layout.js"></script>     -->            
        <!--<script type="text/javascript" src="seatpicker-bestellungsdata-1.js"></script>-->
        <script>
           function getSelectedSeats(){
               
                var seats_json = sc.getCart();
                var seat_data ="";
                var all_selected_seats =[];

                for(var i = 0; i < options.types.length; i++){
                    var seat_type =  options.types[i].type;
                    seat_data += seat_type + " seats: " + sc.getCart()[seat_type] + "// Price pro Sitz: " +sc.getPrice(seat_type)+ "<br>";
                    Array.prototype.push.apply(all_selected_seats, sc.getCart()[seat_type]);               
                }
                //console.log("all_seats: " +   all_selected_seats);
                //console.log("length all_seats: " + all_selected_seats.length);
               
                seat_data += "Total Price: " + sc.getTotal() + options.cart["currency"] ;
                document.getElementById('selected-seats').innerHTML = seat_data + "<br> All seats: " + all_selected_seats ;//+ "   Length All seats: " + all_selected_seats.length;
                
                return all_selected_seats.toString();
            }
//-------------------------------------------------------------------------------------------------------------------------------
            // insert data via AJAX
            </script>
            <script>
           
            // get dynamic variables from url in js
            // Referenz stackoverflow: https://stackoverflow.com/questions/19491336/how-to-get-url-parameter-using-jquery-or-plain-javascript
            $.urlParam = function(name){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if (results==null) {
                return null;
                }
                return decodeURI(results[1]) || 0;
            }
           
            console.log("Film ID (URL Parameter): " + $.urlParam('ID'));

            
            
            $(document).ready(function(){
                $("#seats_to_db_id").click(function(){   
                                                                       
                    var r_seats= getSelectedSeats();
                    var f_id = $.urlParam('ID');
                    console.log("getSelectedSeats: " + getSelectedSeats());
                    //var email=$("#email").val();
                    $.ajax({
                        url:'ajax-insert-reserved-seats.php',
                        method:'POST',
                        data:{
                            reserved_seats:r_seats,
                            film_id : f_id
                        },
                    success:function(data){
                        //alert(data);
                        $('#msg').html(data);
                        //window.location.reload();
                    }
                    });
                });
            });
            </script>
    </body>
</html>