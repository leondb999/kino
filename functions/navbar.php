
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
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
        <a class="nav-link" href="/kino/about.php"> Über uns </a>
      </li>
    </ul>
    
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item">
        <?php if(!isset($_SESSION['username'])): ?>
          <a class="nav-link" href="/kino/login.php"><i class="fas fa-user"></i> Login </a>
          <?php else: ?>
            <a class="nav-link" href="/kino/logout.php"><i class="fas fa-user"></i> Logout </a>
           
          <?php endif; ?>
      </li>    
      <li>
        <a class="nav-link" href="/kino/geheim.php"><i class="fas fa-shopping-cart"></i> Geheim </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Warenkorb </a>
      </li>  
    </ul>
  </div>  
</nav>