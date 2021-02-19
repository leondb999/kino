<?php include('./variables/connection_secrets.php') ?>
<?php

    $connect = mysqli_connect($servername, $username, $password);
    //get all films from DB
    function make_query($connect)
    {
    $query = "Select * From kinoticketing.film Limit 3";
    $result = mysqli_query($connect, $query);
    return $result;
    }

    function make_slide_indicators($connect)
    {
    $output = ''; 
    $count = 0;
    // hole alle Daten aus der DB
    $result = make_query($connect);
    while($row = mysqli_fetch_array($result))
    {
    if($count == 0)
    {
    $output .= '
    <li data-target="#top-film-carousel" data-slide-to="'.$count.'" class="active"></li>
    ';
    }
    else
    {
    $output .= '
    <li data-target="#top-film-carousel" data-slide-to="'.$count.'"></li>
    ';
    }
    $count = $count + 1;
    }
    return $output;
    }

    function make_slides($connect)
    {
    $output = '';
    $count = 0;
    $result = make_query($connect);
    while($row = mysqli_fetch_array($result))
    {
    if($count == 0)
    {
        //style="background-image: url('.$row["Image_Slider_Path"].' )"
    $output .= '<div class="carousel-item active" style ="background-image: url('.$row["Image_Slider_Path"].')">';
    }
    else
    {
        //style="background-image: url('.$row["Image_Slider_Path"].' )"
    $output .= '<div class="carousel-item" style ="background-image: url('.$row["Image_Slider_Path"].')">';
    }
    $output .= '
    
    <div class="carousel-caption">
        <h3>'.$row["Name"].'</h3>
    </div>
    </div>
    ';
    $count = $count + 1;
    }
    return $output;
    }

?>