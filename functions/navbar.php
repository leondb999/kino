
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
          <a class="nav-link" href="./login.php"><i class="fas fa-user"></i> Login </a>
        </li>
        <!-- Nutzer ist eingelogged -->
          <?php else: ?>
          <li class="nav-item">
            <a class="nav-link" href="./logout.php"><i class="fas fa-user"></i> Logout </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./profil.php"><i class="fas fa-user"></i> Profil </a>
          </li> 
          <li>
            <a class="nav-link" href="./geheim.php"><i class="fas fa-shopping-cart"></i> Geheim </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./warenkorb.php"><i class="fas fa-shopping-cart"></i> Warenkorb </a>
          </li>  
          <?php endif; ?>   
      
    </ul>
  </div>  
</nav>