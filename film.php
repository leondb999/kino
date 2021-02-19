<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="/kino/index.php"> DHBW-Kino Mannheim </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/kino/kinoprogramm.php"> Kinoprogramm </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"> Über uns </a>
      </li>
    </ul>

    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-user"></i> Login </a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Warenkorb </a>
      </li>  
    </ul>
  </div>  
</nav>

<br>

<div class="container">
  <div class="row">
    <div class="col-xl">
        <img class="img-fluid" src="./images/Star_Wars_Episode_3.jpg">
    </div>
    <div class="col-xl">
        <h2> Star Wars Episode III: Die Rache der Sith </h2>
        <br>
        <p>Hier kommt eine kurze Beschreibung des Films neben das Filmcover...</p>
    </div>
  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-xl">
        <h4> Filmdetails </h4>
        <br>
        <p>Hauptdarsteller: Hayden Christensen, Ewan McGregor, Natalie Portman, Ian McDiarmid</p>
        <p>Regisseur: George Lucas</p>
        <p>Altersfreigabe: FSK 12</p>
        <p>Dauer: 140min</p>
        <p>Veröffentlichung: 2005</p>
    </div>
    <div class="col-xl">
        <iframe class="responsive-iframe" width="700" height="395" src="https://www.youtube.com/embed/2P_kaYqH8qk?autoplay=1"></iframe>
    </div>
  </div>
</div>

</body>
</html>