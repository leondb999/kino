<?php include('./functions/database_config.php') ?>
<?php 
    //Daten von AJAX (ticket_picking.php)
    $reserved_seats=$_POST['reserved_seats'];
    $film_ID = $_POST['film_id'];
    $user_username = $_POST['user_username'];
    $seat_names = $_POST['selected_seats_name'];
    $total_price = $_POST['total_price'];
    $date = $_POST['date'];
    $time = $_POST['time'];       
   
    // DB-Abfrage: Film Namen
    $sql_get_film = "Select * From kinoticketing.film Where ID =".$film_ID;
    $film_n=  mysqli_fetch_assoc(mysqli_query($con, $sql_get_film));
    $film_name = $film_n['Name'];

    // DB-Abfrage: reserved_seats einer Film_ID, Date und Time (Buchungsdaten)
    $film_seats =  mysqli_fetch_assoc(mysqli_query($con, "Select * From kinoticketing.seat_picking Where Film_ID=  $film_ID And  Date ='$date' And Time='$time'")); // '2021-03-18'    $film_seats ist ein Array mit den Keys "Film_ID", "reserved_seats", "Film_Name" usw | Stand 05.03.2021    
    echo "-------------------PHP ------------------\n";
    // -------------------------------------------------------
    //!!!  Wichtig Es darf vor dem  echo "\nno seats selected strlen==0:".strlen($reserved_seats); keine Zahl im echo stehen !!! sonst wird bei dem Alert angezeigt, dass eine Karte gebucht wurde obwohl keine Karte ausgewählt wurde
    //----------------------------------------------------

    // Daten entsprechend INSERT / UPDATE in DB            
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
           
            if(isset($result_bestellung_in_db)){
                echo "\n\nData successfully in user_schaut_film inserted ( bereits gebucht)\n";
            }
        } else {
            echo "\nkeine Sitze in DB gefunden -----------------"; 

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
    
    ?>