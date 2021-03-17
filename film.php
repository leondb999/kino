<?php session_start(); ?>
<?php include ('./variables/connection_secrets.php') ?>
 
  <?php include('./functions/database_config.php') ?>
  <?php
    // get ID from URL
    //https://www.geeksforgeeks.org/how-to-get-parameters-from-a-url-string-in-php/#:~:text=The%20parameters%20from%20a%20URL,a%20URL%20by%20parsing%20it.
    $url = $_SERVER['REQUEST_URI'];
    $url_components = parse_url($url); 
    parse_str($url_components['query'], $params);  
    $id_film = $params['ID'];
    mysqli_set_charset($con,"utf8");
    $result_all_films = mysqli_query($con, "Select * from kinoticketing.film");
    $sql_film_id = "Select * from kinoticketing.film where ID=".$id_film;
    $result_film_id= mysqli_query($con,  $sql_film_id);
    $film = mysqli_fetch_assoc($result_film_id);
  ?>
<!DOCTYPE html>
<html>
<head> 
  <title><?php echo $film["Name"] ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet"type="text/css" href="style.css"> 
  <!-- Datepicker -->
  <link rel="stylesheet" type="text/css"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css"  href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <!-- Sweet Alert -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />       
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body style="background-color: black; color: white">
  <header>
    <?php include('./functions/navbar.php') ?>
  </header>

  <main role="main" style="padding-top: 25px; padding-bottom: 30px">
    <?php $bg_image =  $film["Image_Slider_Path"]; ?>
    <!-- d-flex  align-items-center-->
    <div class="d-flex jumbotron-fluid align-items-center" style="   background-image: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%,rgba(0,0,0,0.6) 100%),url('<?php echo $bg_image ?>'); height: 100vh; color: white; background-repeat: no-repeat; background-size: cover;"> 
      <div class="container">   
        <br>     
        <br>
        <h1 class="display-1" style="text-align: center;"><?php echo $film["Name"] ?> </h1> 
        <br>     
        <br>
        <h2>Wähle deine Filmzeit</h2>
        <br>      
        <div class="row">
          <div class="col-sm">
            <input type="text" name="to_date" id="input_date" class="form-control dateFilter" placeholder="To Date" />          
          </div>
          <div class="col-sm">
              <div class="form-group">               
                <select class="form-control" id="drop_uhrzeit">
                  <?php foreach(['15:00-17:00', '17:00-20:00', '20:00-22:00', '22:00-24:00'] as $time): ?>
                    <option><?php echo $time ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          </div>        
        </div>
        <button id="btn_buy_tickets" type="button" class="btn btn-primary"  onclick="nav_buy_tickets()" >Bestelle tickets</button><!--  onclick="window.location.href = '/kino/ticket_picking.php?ID=<?php echo $film['ID'] ?>'"-->     
      </div>      
    </div>

    <div class="container">
      
      <div class="row">
        <div class="col-xl">
               
           <!--<img class ="bg-img" src="<?php echo $film["Image_Slider_Path"] ?>" class="img-fluid" alt="Responsive image">-->
        </div>
      </div>
      <div class="row">
      <div class="col-xl">
        <br>
        <h2><?php echo $film["Name"] ?> </h2>
        <br>
        <p><?php echo $film["Long_Description"] ?></p>
      </div>
      </div>
      <br>
      <div class="row">
        <div class="col-xl">
            <h4> Filmdetails </h4>
            <br>
            <p>Hauptdarsteller: <?php echo $film["Hauptdarsteller"] ?></p>
            <p>Regisseur: <?php echo $film["Regisseur"] ?></p>
            <p>Altersfreigabe: <?php echo $film["FSK"] ?></p>
            <p>Dauer: <?php echo $film["Dauer"] ?> min</p>
            <p>Veröffentlichung: <?php echo $film["Jahr"] ?></p>
            <br>
        </div>
        <div class="col-xl">
            <iframe class="responsive-iframe" width="700" height="395" src="<?php echo $film["Trailer"] ?>"></iframe>
        </div>
      </div>
      <br>
      <br>
     
    </div>
  </main>

  <footer class="py-3 bg-dark" style="color: grey">
    <?php include('./functions/footer.php') ?>
  </footer>
  

<script>


  $(document).ready(function () {
    $('.dateFilter').datepicker({
      minDate: new Date(),
     dateFormat: "yy-mm-dd"
    });   
  });

  </script>
  <script>
              //navigate to Filmseite mit ausgewählter 
              function nav_buy_tickets(){
                var date = document.getElementById('input_date').value;
                var time = document.getElementById('drop_uhrzeit').value;
                console.log("Selection Uhrzeit: " + time);                
                if(!date.length == 0){
                  window.location.href = '/kino/ticket_picking.php?ID=<?php echo $film['ID'] ?>'+"&Date="+date+"&Time="+time;                
                } else {
                  swal({title: "Wähle eine Datum aus an dem du den Film sehen möchtest ",icon: "error",button: "Ok"});
                }
            }

      </script>
</body>
</html>