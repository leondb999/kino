<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
  
    $con = mysqli_connect($servername, $username, $password);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
      } 
    if ($con){
        echo "Connected successfully to ".$servername." with User: ".$username."<br>";
    }
    
    // hole die reserved_seats und die film_ID von AJAX
    $reserved_seats=$_POST['reserved_seats'];
    $film_ID = $_POST['film_id'];
    
    // hole den Film Namen
    $sql_get_film = "Select * From kinoticketing.film Where ID =".$film_ID;
    $film_n=  mysqli_fetch_assoc(mysqli_query($con, $sql_get_film));
    $film_name = $film_n['Name'];
    echo "Film Name: ". $film_name."<br>";

    // hole Sitz Buchungsdaten für eine Film_ID aus seat_picking
    $sql_get_seats_by_filmID = "Select * From kinoticketing.seat_picking Where Film_ID= $film_ID";
    $film_seats =  mysqli_fetch_assoc(mysqli_query($con, $sql_get_seats_by_filmID)); // $film_seats ist ein Array mit den Keys "Film_ID", "reserved_seats", "Film_Name" usw | Stand 05.03.2021
    
    // prüfe, ob ein seat selected wurde, wenn kein Sitz ausgewählt wurde ist Stringlänge gleich  0
    if(strlen($reserved_seats)==0){
        echo "no seat selected,, String Länge: ". strlen($reserved_seats);   
    } else {
        echo "seat länge selected: ".strlen($reserved_seats);
        
        // check, ob bereits Sitze für den Film gebucht wurden 
        if($film_seats){
            echo "<p>Die Sitze".$film_seats['reserved_seats']." bereits zu Film ".$film_ID." gebucht</p>";
            
            echo "<h4>Bei dem Film wurde bereits gebucht:<br>Film_ID: ".$film_seats['Film_ID'].", Seats: ".$film_seats['reserved_seats']."</h4>";//$film['reserved_seats']
            //echo "<p> Film_ID: ".$film_seats['Film_ID'].", Seats: ".$film_seats['reserved_seats']."</p>";
       

            // füge bereits belegte sitze und neue ausgewählte sitze zusammen
            $updated_seat_str =  $film_seats['reserved_seats'].",".$reserved_seats;

            $result_film_seats_update = mysqli_query($con, "Update kinoticketing.seat_picking SET reserved_seats = '$updated_seat_str' Where Film_ID = $film_ID");
            // wenn die Daten erfolgreich upgedatet wurden                        
            if($result_film_seats_update){
                // display updated seats:
                $film_seats_uo =  mysqli_fetch_assoc(mysqli_query($con, $sql_get_seats_by_filmID));
                echo "<p> Data sucessfully updated: FilmID: ".$film_seats['Film_ID'].", Seats: ".$updated_seat_str."</p>";                       
            }
             
        } else { // wenn bisher keine Sitze zu diesem Film gebucht wurden

            echo "<p> keine Sitze bisher bei Film ".$film_ID." gebucht</p><br>";
            // füge die ausgewählten Sitze mit Film_ID in DB ein
            $sql_insert_seats="Insert INTO kinoticketing.seat_picking (reserved_seats, Film_ID, Film_Name) VALUES ('$reserved_seats', '$film_ID', '$film_name')";
            // wenn die Daten erfolgreich eingefügt wurden    
            if ($con->query($sql_insert_seats) === TRUE) {
                echo "data inserted - FilmID:".$film_ID.", Seats:".$reserved_seats;
            } else {
                echo  "Error: " . $sql . "<br>" . mysqli_error($con);
            }                                        
        } //!$film_seats
    } 

   




    ?>