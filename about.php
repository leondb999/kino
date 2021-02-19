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
    <h2> Über uns </h2>
    <br>
    <div class="row">
        <div class="col-xl" style="margin-bottom: 2em">
            <img width="330" height="330" src="./images/Leon.jpg">
            <p>Geschäftsführer: Leon Dickob</p>
        </div>
        <div class="col-xl" style="margin-bottom: 2em">
            <img width="330" height="330" src="./images/Nico.jpg">
            <p>Geschäftsführer: Nicolas Schneider</p>
        </div>
    </div>
</div>
<div class="container">
  <h4> DHBW-Kino Mannheim </h4>
  <br>
  <div class="row">
    <div class="col-xl" style="margin-bottom: 2em">
        <p><strong>Kino:</strong></p>
        <p>Coblitzallee 1, 68163 Mannheim </p>
        <br>
        <p><strong>Öffnungszeiten:</strong><p>
        <table class="table">
            <tr>
                <th scope="col">Montag</th>
                <th scope="col">16:00Uhr - 00:00Uhr</th>
            </tr>
            <tr>
                <th scope="col">Dienstag</th>
                <th scope="col">14:00Uhr - 22:00Uhr</th>
            </tr>
            <tr>
                <th scope="col">Mittwoch</th>
                <th scope="col">14:00Uhr - 00:00Uhr</th>
            </tr>
            <tr>
                <th scope="col">Donnerstag</th>
                <th scope="col">14:00Uhr - 22:00Uhr</th>
            </tr>
            <tr>
                <th scope="col">Freitag</th>
                <th scope="col">14:00Uhr - 00:00Uhr</th>
            </tr>
            <tr>
                <th scope="col">Samstag</th>
                <th scope="col">14:00Uhr - 00:00Uhr</th>
            </tr>
            <tr>
                <th scope="col">Sonntag</th>
                <th scope="col">14:00Uhr - 22:00Uhr</th>
            </tr>
        </table>
    </div>
    <div class="col-xl" style="margin-bottom: 2em">
        <div style="width: 100%">
            <iframe scrolling="no" marginheight="0" marginwidth="0" 
                src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Coblitzalle%201,%2068163%20Mannheim+(DHBW-Kino%20Mannheim)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" 
                width="100%" 
                height="600" 
                frameborder="0">
            </iframe>
        </div>
    </div>
  </div>
</div>
<div class="container">
    <br>
    <br>
    <div class="row">
        <div class="col-xl" style="margin-bottom: 2em">
            <img src="./images/dhbw-kino.jpg">
        </div>
        <div class="col-xl" style="margin-bottom: 2em">
            <p>Unser DHBW-Kino befindet sich im Herzen des Rhein Neckar Gebiets, in unmittelbarer Nähe zum City Airport Mannheim. Außerdem sind wir dank unserer eigenen S-Bahn 
                Station auch sehr gut mit den öffentlichen Verkehrsmitteln zu erreichen. Zusätzlich ist die Parkplatzsituation sehr komfortabel und sie haben eine sehr einfache
                Anfahrt mit ihrem Auto.</p>
            <p>Mit unseren 40 Jahren Erfahrung sind wir eines der traditionsreichsten Kinos in der gesamten Umgebung und zugleich auch eins der größten mit unseren 12 Kinosälen
                und über 2000 Sitzplätzen. Im DHBW-Kino Mannheim können sie immer die neusten Filme in bester Qualität und mit sattem Dolby Sound genießen.</p>
            <br>
            <p>Wir freuen uns auf Ihren Besuch</p>
            <p><strong>Ihr DHBW-Kino Team</strong></p>
        </div>
    </div>
    <br>
</div>    
</body>
</html>