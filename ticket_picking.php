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
        <title>Tickets</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/seatchart.css">
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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script> -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
            .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
          
            color: grey;
            text-align: center;
            }
        </style>   
    </head>
    <?php include('./functions/database_config.php') ?>
    <?php
            // get Film Data by url parameter 
            
            $url = $_SERVER['REQUEST_URI'];
            $url_components = parse_url($url); 
            parse_str($url_components['query'], $params);  
            $id_film = $params['ID'];
            $date_film = $params['Date'];
            $time_film = $params['Time'];
        
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

    <body > <!--style="background-color: black; color: white"-->
        <header>
            <?php include('./functions/navbar.php') ?>
        </header>

        <main role="main" style="padding-top: 10px; padding-bottom: 50px">         
            <section class="py-2 m-10">
               
                <div class="container" style="padding-top: 20px">
                    <h3 class="display-4">Sitzauswahl</h3> 
                    <p> Info: Lösche Sitze per Rechtsklick aus der Auswahl, oder in der Mobilen Ausicht durch langes draufdrücken</p>
                   <?php  echo "Date: ".$date_film.", Time: ".$time_film; ?>
                </div>    

                         <!--<div class="content"> -->
                            <div class="row content" style ="margin-bottom: 50px;">
                            
                                <div class="col-sm-auto col-xs-12">
                                    <div id="legend-container" class=" d-flex justify-content-center align-items-center"></div> 
                                </div> 
                                <div class="col-sm-">
                                    <div id="map-container"></div>
                                    <div class=" d-flex justify-content-center align-items-center" style = "margin-top: 10px;">
                                        <button type="submit" class=" btn btn-outline-primary" name= "seats_to_db" id="seats_to_db_id" >Buche Ticket</button>
                                    </div>                                                       
                                </div>
                                <div class="col-sm-auto d-flex justify-content-center align-items-center"> 
                                                                     
                                    <div id="cart-container" class=" d-flex justify-content-center align-items-center"></div>
                                </div>
                     
                            </div>
                       <!-- </div>-->                
                <!--</div> -->
            </section>
        </main>
        
<!--
        <footer class="py-3 bg-dark" style="color: grey; margin-bottom: 0px">
        
        </footer>
    -->
    <footer class="footer py-3 bg-dark">
        <?php include('./functions/footer.php') ?>
    </footer>


        <script type="text/javascript" src="./js/seatchart.js"></script>
        <?php 
            // get reserved seats from db für einen Speziellen Film an einem bestimmten Datum zu einer bestimmten Uhrzeit  
        
            /// !!! hier könnte man mit AJAX 
            $f_ID_seat = $film['ID'];
            $result_user_data = mysqli_fetch_array(mysqli_query($con, "Select reserved_seats From kinoticketing.seat_picking Where Film_ID = $f_ID_seat And Date= '$date_film' And Time='$time_film'")); //'2021-03-18' '15:00-17:00'
                       
            if(isset($result_user_data)){
                //echo "variable is definded";
                $r_seats_str = $result_user_data['reserved_seats'];   
                echo "Reservierte Sitze: ".$r_seats_str;      
            }

            if(!isset($result_user_data)){
                echo "variable is undefined";
            }
            $reserved_seats_db_arr = explode(',',$r_seats_str);         
        ?>
        <script>            
            // API Referenz des Seatpickers https://seatchart.js.org/api.html#Seatchart
            console.log(document.getElementById("map-container"));
            var js_array = [<?php echo '"'.implode('","',  $reserved_seats_db_arr ).'"' ?>];
            var options = {
                // Reserved and disabled seats are indexed from left to right by starting from 0.  Given the seatmap as a 2D array and an index [R, C] the following values can obtained as follow:
                // I = columns * R + C
                map: {
                    id: 'map-container',
                    rows: 8,
                    columns: 9,
                    // e.g. Reserved Seat [Row: 1, Col: 2] = 7 * 1 + 2 = 9
                    reserved: {
                        seats: js_array
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
            console.log("sc.getCart(): ", sc.getCart());
        </script>
        <script>
        document.getElementsByClassName("sc-cart-delete").style.visibility = "hidden";
        </script>
        
        <script>
           function getSelectedSeats(){
               
                var seats_json = sc.getCart();
                var seat_data ="";
                var selected_seats_index =[];
                var selected_seats_name = [];
                
                for(var i = 0; i < options.types.length; i++){
                    var seat_type =  options.types[i].type;
                    seat_data += seat_type + " seats: " + sc.getCart()[seat_type] + "// Price pro Sitz: " +sc.getPrice(seat_type)+ "<br>";
                    Array.prototype.push.apply(selected_seats_index, sc.getCart()[seat_type]);  
                    if(selected_seats_index.length != 0){
                        // add Sitz Name z.B: F( hinzu)
                        
                        for (var i = 0; i < selected_seats_index.length; i++){                                                      
                            selected_seats_name.push(sc.get(selected_seats_index[i]).name);                            
                        }
                    }                                                               
                }

                console.log("seat_names: " + selected_seats_name.toString());
               
                seat_data += "Total Price: " + sc.getTotal() + options.cart["currency"] ;
               // document.getElementById('selected-seats').innerHTML = seat_data + "<br> All seats: " + selected_seats_index + "<br> Seat Names: " +  selected_seats_name.toString();//+ "   Length All seats: " + selected_seats_index.length;
                
                return {
                    selected_seats_index:    selected_seats_index.toString(),
                    total_price : sc.getTotal(),
                    selected_seats_name : selected_seats_name.toString()
                }
            }
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

            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return parts.pop().split(';').shift();
                }
            
            $(document).ready(function(){
               
                $("#seats_to_db_id").click(function(){   
                    var r_date = $.urlParam('Date');
                    console.log("date: " +r_date);
                    //console.log("\ntime: " +r_time);
                    var r_time = $.urlParam('Time');
                                       
                    var bestellungsdata = getSelectedSeats();                                                                  
                    var r_seats = bestellungsdata.selected_seats_index;
                    var r_seat_names = bestellungsdata.selected_seats_name;
                    var r_total_price = bestellungsdata.total_price;
                    var f_id = $.urlParam('ID');
                    var u_username = getCookie("username_cookie");
                    console.log("getSelectedSeats: " + getSelectedSeats());
                    
                    //var email=$("#email").val();
                    $.ajax({
                        url:'ajax-insert-reserved-seats.php',
                        method:'POST',
                        data:{
                            reserved_seats:r_seats,
                            film_id: f_id,
                            user_username: u_username,
                            selected_seats_name: r_seat_names,
                            total_price: r_total_price,
                            date: r_date,
                            time: r_time
                        },
                    success:function(data){
                         
                        // prüft, ob Sitze ausgewählt wurden, wenn die Stringlänge von selected_seats == 0 ist, dann wurde keiner ausgewählt, ansonsten schon 
                        var selected_seats_length  = /[0-9]/.exec(data); console.log("regexp:" + selected_seats_length);
                        console.log("Selected Seats länge: " + selected_seats_length);
                        console.log(data)
                        if( selected_seats_length != 0){
                            // Sitze wurden ausgewählt, Buchung erfolgreich
                            swal(
                                    {
                                        title: "Ticket gebucht",
                                        text: "Klicke OK, um den Kauf im Profil einzusehen",
                                        icon: "success",
                                        button: "Ok"
                                    }
                                ).then((value) => {                               
                                    //window.location.reload(); //lade Seite neu                         
                                    location.assign('./profil.php'); //navigiere nach Kauf direkt zum Profil. Dort sieht der User nun das gekaufte Ticket 
                                });
                            } else{
                                // Es wurden keine Sitze ausgewählt. Besucher muss Sitz auswählen 
                                swal(
                                    {
                                        title: "Wähle einen Sitzplatz aus!",                                       
                                        icon: "error",
                                        button: "Ok"
                                    }
                                )
                            }
                        }
                    });
                });
            });

        </script>
    
    </body>
</html>
