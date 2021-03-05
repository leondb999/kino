<?php include('./functions/database_config.php') ?>

<?php
    $f_ID_seat = 6;
    $result_user_data = mysqli_query($con, "Select reserved_seats From kinoticketing.seat_picking Where Film_ID = '$f_ID_seat'");
    while($r_seats = mysqli_fetch_array($result_user_data)){
      $r_seats_str = $r_seats['reserved_seats'];
    }
    $reserved_seats_db_arr = explode(',',$r_seats_str);
    print_r($reserved_seats_db_arr) ;
?>