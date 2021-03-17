<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
  
    $con = mysqli_connect($servername, $username, $password);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
      } 
    if ($con){
       // echo "Connected successfully to ".$servername." with User: ".$username."\n";
    }
    // hole die reserved_seats und die film_ID von AJAX
    $reserved_seats=$_POST['reserved_seats'];
    $film_ID = $_POST['film_id'];
    $user_username = $_POST['user_username'];
    $seat_names = $_POST['selected_seats_name'];
    $total_price = $_POST['total_price'];
    $date = $_POST['date'];
    $time = $_POST['time'];       
    // hole den Film Namen

    $sql_get_film = "Select * From kinoticketing.film Where ID =".$film_ID;
    $film_n=  mysqli_fetch_assoc(mysqli_query($con, $sql_get_film));
    $film_name = $film_n['Name'];
  
   // echo "\nReserved SSeats: ".$reserved_seats."\n";
    //$sql_insert_seats="Insert INTO kinoticketing.seat_picking (reserved_seats, Film_ID, Film_Name, Date) VALUES ('$reserved_seats', '$film_ID', '$film_name', '$date')";
    //$result_date = mysqli_query($con,$sql_insert_seats);   
    // hole Sitz Buchungsdaten für eine Film_ID aus seat_picking

    $film_seats =  mysqli_fetch_assoc(mysqli_query($con, "Select * From kinoticketing.seat_picking Where Film_ID=  $film_ID And  Date ='$date' And Time='$time'")); // '2021-03-18'    $film_seats ist ein Array mit den Keys "Film_ID", "reserved_seats", "Film_Name" usw | Stand 05.03.2021    
    echo "-------------------PHP ------------------\n";
    // -------------------------------------------------------
    //!!!  Wichtig Es darf vor dem  echo "\nno seats selected strlen==0:".strlen($reserved_seats); keine Zahl im echo stehen !!! sonst wird bei dem Alert angezeigt, dass eine karte gebucht wurde obwohl keine Karte ausgewählt wurde
    //----------------------------------------------------

    // vor dem e
    //echo "film_seats: ".$film_seats['reserved_seats'];

            
    if(strlen($reserved_seats) == 0){
        echo "\nno seats selected strlen==0:".strlen($reserved_seats);
    } else {
        echo "\nseats selected: ".$reserved_seats;
        if(isset($film_seats)){
            echo "\n\nsitze in DB gefunden----------------\nfilm_seats: ".$film_seats['reserved_seats']." Date: ".$date." Time: ".$time;
            $updated_seat_str =  $film_seats['reserved_seats'].",".$reserved_seats;      
            // UPDATE seat_picking
            $result_film_seats_update = mysqli_query($con, "Update kinoticketing.seat_picking SET reserved_seats = '$updated_seat_str' Where Film_ID = $film_ID And Date='$date' And Time='$time'");        // '2021-03-18'
            
            // INSERT user_schaut_film
            $result_bestellung =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names, Total_Price, Date, Time) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names', '$total_price', '$date', '$time')");
            //$result_bestellung_in_db =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names, Total_Price, Date ) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names', '$total_price', '$date')"); //   
            
            if(isset($result_bestellung_in_db)){
                echo "\n\nData successfully in user_schaut_film inserted ( bereits gebucht)\n";
            }

        } else {
            echo "\nkeine Sitze in DB gefunden -----------------";//.$film_seats['reserved_seats'];        
            $result_bestellung_new =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names, Total_Price, Date ) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names', '$total_price', '$date')"); //   
            if(isset($result_bestellung_new)){
                echo "\n\nData successfully in user_schaut_film inserted (noch nicht gebucht)\n";
            }
            $result_insert_seats = mysqli_fetch_assoc(mysqli_query($con, "Insert INTO kinoticketing.seat_picking (reserved_seats, Film_ID, Film_Name, Date, Time) VALUES ('$reserved_seats', '$film_ID', '$film_name', '$date', '$time')"));                      
            
            if(isset($result_insert_seats)){
                echo "\n\nData successfully in seat_picking inserted (noch nicht gebucht)\n";
            } else {
                echo "No Data in seat_picking inserted";
            }
           
            
           
        }
    }
    // Füge Bestellung zu Profil hinzu         
    // prüfe, ob ein seat selected wurde, wenn kein Sitz ausgewählt wurde ist Stringlänge gleich  0
    /*
    if(strlen($reserved_seats) == 0){
        echo " reserved_seats_str:".strlen($reserved_seats."\n");   //reserved_seats ist ein string
    } else {
        echo "helloooooooooooooooooo";
        echo "selected_seats_str:".strlen($reserved_seats).";\n"; 
        echo " selected_seats:".$reserved_seats; 
        if($film_seats){
            // füge bereits belegte sitze und neue ausgewählte sitze zusammen
            $updated_seat_str =  $film_seats['reserved_seats'].",".$reserved_seats;            
            $result_film_seats_update = mysqli_query($con, "Update kinoticketing.seat_picking SET reserved_seats = '$updated_seat_str' Where Film_ID = $film_ID And Date='2021-03-10'");        // $'2021-03-10'              
            // Füge bestellung zu Warenkorb hinzu
            $result_bestellung =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names, Total_Price) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names', '$total_price')");            
            // wenn die Daten erfolgreich upgedatet wurden                        
            if($result_film_seats_update){
                // display updated seats:
                $film_seats_uo =  mysqli_fetch_assoc(mysqli_query($con, $sql_get_seats_by_filmID));
                echo "Data sucessfully updated beim Film_ID:[".$film_seats['Film_ID']."];\n updated Seats:".$updated_seat_str.";\n";                       
            }
        } else { // wenn bisher keine Sitze zu diesem Film gebucht wurden           
            // füge die ausgewählten Sitze mit Film_ID in DB ein
            $sql_insert_seats="Insert INTO kinoticketing.seat_picking (reserved_seats, Film_ID, Film_Name, Date) VALUES ('$reserved_seats', '$film_ID', '$film_name', '$date')";
            // Füge bestellung zu Warenkorb hinzu---------------------------------------------------------------         
            $result_bestellung =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names, Total_Price, Date) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names', '$total_price', '$date')");
            // wenn die Daten erfolgreich eingefügt wurden    
            if ($con->query($sql_insert_seats) === TRUE) {
                echo "Daten erfolgreich eingefügt FilmID:".$film_ID."; Seats:".$reserved_seats."; Date: ".$date;
            } else {
                echo  "Error: " .$sql."<br>".mysqli_error($con);
            }                                        
        } //!$film_seats
    } */
    ?>