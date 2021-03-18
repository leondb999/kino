<?php session_start(); ?>
<?php
/*  Prüft, ob ein Cookie verfügbar ist,
    wenn das nicht der Fall ist wird man automatisch zur Login Page geleitet*/
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script> 
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link rel ="stylesheet"type="text/css" href="style.css"> 
        <!-- Sweet Alert -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <style>
            /* Style for the Seatpicker */
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
            // Hole Parameter aus der URL in ein Array          
            $url = $_SERVER['REQUEST_URI'];
            $url_components = parse_url($url); 
            parse_str($url_components['query'], $params);  
            $id_film = $params['ID'];
            $date_film = $params['Date'];
            $time_film = $params['Time'];
        
            mysqli_set_charset($con,"utf8");         
            $result_film_id= mysqli_query($con,  "Select * from kinoticketing.film where ID=".$id_film);
            $film = mysqli_fetch_assoc($result_film_id);                    
    ?>
    <?php include('./functions/get_user_data_cookie.php'); // get Data from Person by Username that is stored in cookie.  returns userdata as user_cookie?>
   

    <body >
        <header>
            <?php include('./functions/navbar.php') ?>
        </header>
        <main role="main" style="padding-top: 20px">    
        <!-- Überschrift, Canvas-Ausgebucht, Date, Time -->     
            <section class="py-2 m-10">               
                <div class="container" style="padding-top: 30px; margin-bottom: -50px">
                    <!--Film Name -->
                    <div class="d-flex justify-content-center">
                        <p class="d-flex justify-content-center display-4"><?php echo $film['Name']?> </p>
                    </div>
                    <!-- Ausgebucht Canvas -->
                    <div class="d-flex justify-content-center" style="margin-bottom: 20px;">                   
                        <canvas id="Canvas_Prozent_Reserved_Seats" width="170" height="170"></canvas>                      
                    </div>
                    <!-- Date, Time -->
                    <div>                        
                        <p class="d-flex justify-content-center "><?php echo $date_film?></p>
                        <p class="d-flex justify-content-center "><?php echo $time_film?></p>                                           
                    </div>                                                                                                 
                </div> 
            </section>

        <!-- Seatpicker, Legende, Selected-Tickets-Card -->
            <section>   
                <div class="row content" style ="margin-bottom: 70px;">  
                    <!--Legende -->              
                    <div class="col-sm-auto col-xs-12">
                        <div id="legend-container" class=" d-flex justify-content-center align-items-center"></div> 
                    </div> 
                    <!-- Seatpicker & Bestell-Button -->
                    <div class="col-sm-">
                        <div id="map-container"></div>
                        <div class=" d-flex justify-content-center align-items-center" style = "margin-top: 10px;">
                            <button type="submit" class=" btn btn-outline-primary" name= "seats_to_db" id="seats_to_db_id" >Buche Ticket</button>
                        </div>                                                       
                    </div>
                    <!-- Selected-Tickets-Card -->
                    <div class="col-sm-auto d-flex justify-content-center align-items-center">                                                             
                        <div id="cart-container" class=" d-flex justify-content-center align-items-center"></div>
                    </div>            
                </div>
            </section>
        </main>

    <footer class="footer py-3 bg-dark">
        <?php include('./functions/footer.php') ?>
    </footer>

        <!-- externes Seatpicker Script --> 
        <script type="text/javascript" src="./js/seatchart.js"></script>
        <?php 
            //DB-Abfrage: Hole den  reserved_seats-String eines bestimmten Filmes, Datum und Uhrzeit            
            $f_ID_seat = $film['ID'];
            $result_user_data = mysqli_fetch_array(mysqli_query($con, "Select reserved_seats From kinoticketing.seat_picking Where Film_ID = $f_ID_seat And Date= '$date_film' And Time='$time_film'")); //'2021-03-18' '15:00-17:00'
                       
            if(isset($result_user_data)){
                $r_seats_str = $result_user_data['reserved_seats'];                   
            }
            /*
            if(!isset($result_user_data)){
                echo "variable is undefined";
            }*/   
            $reserved_seats_db_arr = explode(',',$r_seats_str);   
               
        ?>

        <script>            

           
            var js_array = [<?php echo '"'.implode('","',  $reserved_seats_db_arr ).'"' ?>];
            var max_sitze = 54;
            console.log("Prozent: " + (js_array.length/max_sitze)*100)

            // Canvas Referenz: https://www.tothenew.com/blog/tutorial-to-create-a-circular-progress-bar-with-canvas/
            var canvas = document.getElementById('Canvas_Prozent_Reserved_Seats');
            var context = canvas.getContext('2d');
            var al=0;
            var start=4.72;
            var cw=context.canvas.width/2;
            var ch=context.canvas.height/2;
            var diff;
            
            function progressBar(){
                diff=(al/100)*Math.PI*2;
                context.clearRect(0,0,100,50);
                context.beginPath();
                context.arc(cw,ch,100,0,2*Math.PI,false);
                context.fillStyle='#FFF';
                context.fill();
                context.strokeStyle='#FFF'; //# e7f2ba
                context.stroke();
                context.fillStyle='#000';
                context.strokeStyle='#a0d3de'; //b3cf3c
                context.textAlign='center';
                context.lineWidth=10;
                context.font = '10pt Verdana';
                context.beginPath();
                context.arc(cw,ch,80,start,diff+start,false);
                context.stroke();
                context.fillText("Ausgebucht:"+ al+'%',cw+2,ch+6);
                if(al>=(js_array.length/max_sitze)*100-2){
                    clearTimeout(bar);
                }                
                al++;
            }        
            var bar=setInterval(progressBar,80);
            
            console.log("js_array: " + js_array.length);
                        // API Referenz des Seatpickers https://seatchart.js.org/api.html#Seatchart
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
                    // Disabled Seats sind die sitze welche in der Mitte "unsichtbar sind". 
                    disabled: {
                        seats: [0, 8],
                        rows: [4],
                        columns: [4]
                    }
                },
                // Bei Sitzauswahl kann man zwischen zwei Preisklassen auswählen "regular und reduced". Zudem kann man den Preis festlegen
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
                        // \W*((?i)strlen==0:(?-i))\W*
                        var selected_seats_length  = /[0-9]/.exec(data); console.log("regexp:" + selected_seats_length);
                        console.log("\n\n\nSelected Seats länge: " + selected_seats_length);
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
                                    //location.assign('./profil.php'); //navigiere nach Kauf direkt zum Profil. Dort sieht der User nun das gekaufte Ticket 
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
