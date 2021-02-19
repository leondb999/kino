<?php
//index.php
$connect = mysqli_connect("localhost", "root", "");
//get all films from DB
function make_query($connect)
{
 $query = "Select * From kinoticketing.film Limit 4";
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
<!DOCTYPE html>
<html>
 <head>
  <title>How to Make Dynamic Bootstrap Carousel with PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <!-- nicolas navbar-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <!--    External Resources from Tutorial for the Dynamic slider-->
  <!--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->

   
 
  <link rel ="stylesheet"type="text/css" href="style.css">
 </head>
 <body>
  <br />
  <!--<div class="container">-->
   <h2 align="center">How to Make Dynamic Bootstrap Carousel with PHP</h2>
   <br />
   <div id="top-film-carousel" class="carousel slide" data-ride="carousel"  data-interval ="1000">
    
    <!-- Navigations Striche -->
    <ol class="carousel-indicators">
        <?php echo make_slide_indicators($connect); ?>
    </ol>
    <!-- The Slides -->
    <div class="carousel-inner">
     <?php echo make_slides($connect); ?>
    </div>

    <!-- Vor & Zurück Pfeile --> 
    <!-- Rechter- Pfeil -->
    <a class="carousel-control-prev" href="#top-film-carousel" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
     
    </a>
    <!-- Linker Pfeil -->
    <a class="carousel-control-next" href="#top-film-carousel" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
 </body>
</html>