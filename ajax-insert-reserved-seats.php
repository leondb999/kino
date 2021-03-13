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
    $seat_names = $_POST['all_seat_names'];
    
   
    // hole den Film Namen
    $sql_get_film = "Select * From kinoticketing.film Where ID =".$film_ID;
    $film_n=  mysqli_fetch_assoc(mysqli_query($con, $sql_get_film));
    $film_name = $film_n['Name'];
    //echo "Film Name: ". $film_name."<br>";

    // hole Sitz Buchungsdaten für eine Film_ID aus seat_picking
    $sql_get_seats_by_filmID = "Select * From kinoticketing.seat_picking Where Film_ID= $film_ID";
    $film_seats =  mysqli_fetch_assoc(mysqli_query($con, $sql_get_seats_by_filmID)); // $film_seats ist ein Array mit den Keys "Film_ID", "reserved_seats", "Film_Name" usw | Stand 05.03.2021
    
    // prüfe, ob ein seat selected wurde, wenn kein Sitz ausgewählt wurde ist Stringlänge gleich  0
    if(strlen($reserved_seats)==0){
        echo ";no seat selected,hello; reserved_seats_str:;".strlen($reserved_seats);   //reserved_seats ist ein string
    } else {
        echo "seats selected, selected_seats_str:".strlen($reserved_seats).";\n"; 
        //echo "seats selected, selected_seats:[".$reserved_seats."];\n"; 
        // check, ob bereits Sitze für den Film gebucht wurden 
        if($film_seats){
           // echo "Film_ID:".$film_ID."\nalready_booked_seats:[".$film_seats['reserved_seats']."];\n\n";
            // füge bereits belegte sitze und neue ausgewählte sitze zusammen
            $updated_seat_str =  $film_seats['reserved_seats'].",".$reserved_seats;
            
            $result_film_seats_update = mysqli_query($con, "Update kinoticketing.seat_picking SET reserved_seats = '$updated_seat_str' Where Film_ID = $film_ID");
            
            //---------------------------------------------------------------------------------------------
            // Füge bestellung zu Warenkorb hinzu---------------------------------------------------------------         
            $result_bestellung =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names')");

            //----------------------------------------------------------------------------------------------------------
            // wenn die Daten erfolgreich upgedatet wurden                        
            if($result_film_seats_update){
                // display updated seats:
                $film_seats_uo =  mysqli_fetch_assoc(mysqli_query($con, $sql_get_seats_by_filmID));
               // echo "Data sucessfully updated beim Film_ID:[".$film_seats['Film_ID']."];\n updated Seats:".$updated_seat_str.";\n";                       
            }
             
        } else { // wenn bisher keine Sitze zu diesem Film gebucht wurden

           // echo "<p> keine Sitze bisher bei Film ".$film_ID." gebucht</p><br>";
            // füge die ausgewählten Sitze mit Film_ID in DB ein
            $sql_insert_seats="Insert INTO kinoticketing.seat_picking (reserved_seats, Film_ID, Film_Name) VALUES ('$reserved_seats', '$film_ID', '$film_name')";

            // Füge bestellung zu Warenkorb hinzu---------------------------------------------------------------         
            $result_bestellung =  mysqli_query($con, "Insert Into kinoticketing.user_schaut_film (Film_ID, Film_Name, User_Name, Reserved_Seats, Seat_Names) VALUES('$film_ID', '$film_name', '$user_username', '$reserved_seats', '$seat_names')");

            // wenn die Daten erfolgreich eingefügt wurden    
            if ($con->query($sql_insert_seats) === TRUE) {
                echo "Daten erfolgreich eingefügt FilmID:".$film_ID."; Seats:".$reserved_seats.";";
            } else {
                echo  "Error: " . $sql . "<br>" . mysqli_error($con);
            }                                        
        } //!$film_seats
    } 
    ?>