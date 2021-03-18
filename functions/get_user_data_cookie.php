<?php 
    // DB-Abfrage: Nutzerdaten indem man den im Cookie gespeicherten Username ausliest und diesen als Selektionskriterium verwendet
    $tmp_username_cookie = $_COOKIE['username_cookie'];
    $result_user_data = mysqli_query($con, "Select * from kinoticketing.users Where Username = '$tmp_username_cookie'");
    $user_cookie = mysqli_fetch_assoc($result_user_data);
?>