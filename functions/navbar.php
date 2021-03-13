
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
  <a class="navbar-brand" href="/kino/index.php"> DHBW-Kino Mannheim </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="./kinoprogramm.php"> Kinoprogramm </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./about.php"> Über uns </a>
      </li>
    </ul>
    
    <ul class="nav navbar-nav ml-auto">
        <!--Nutzer ist nicht eingelogged -->
        <?php if(!isset($_SESSION['username']) || !isset($_COOKIE['username_cookie'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="./login.php"> Login <i class="fa fa-sign-in"></i></a>
        </li>
        <!-- Nutzer ist eingelogged -->
          <?php else: ?>

          <li class="nav-item">
            <a class="nav-link" href="./profil.php">Profil <i class="fa fa-user"></i> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php">  Logout <i class="fa fa-sign-out" ></i></a>
          </li> 
          
          <?php endif; ?>         
    </ul>
  </div>  
</nav>