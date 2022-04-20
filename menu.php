<?php
if(!isset($_SESSION['logged']))
{
	$_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-danger">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			  <i class="fas fa-times-circle"></i> <strong>Najpierw musisz się zalogować!
			</div>';
    header('Location: index.php');
}
  if($_SESSION['user_type'] == 2)
  { 
  ?>
  <nav class="navbar navbar-expand-lg navbar-dark menu-back">
    <div class="container-fluid">
      <a class="navbar-brand" href="panel.php"><img class="menu-logo" src="img/menu-logo.png"/></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto menu-elements">
          
          <li class="nav-item">
            <a class="nav-link menu-element" href="kanban.php"><i class="fas fa-table"></i> Kanban</a>
          </li>

          <li class="nav-item">
            <a class="nav-link menu-element" href="contractList.php"><i class="fas fa-list-alt"></i> Lista moich zleceń</a>
          </li>

          <li class="nav-item">
            <a class="nav-link menu-element logout" href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj</a>
          </li>
        </ul>
        <form action="search_result.php" method="POST" class="d-flex">
          <input class="form-control me-sm-2" type="text" name = "contract_number" placeholder="Numer zlecenia">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </div>
  </nav>
  <?php 
  }
  else
  {
  ?>


<nav class="navbar navbar-expand-lg navbar-dark menu-back">
    <div class="container-fluid">
      <a class="navbar-brand" href="panel.php"><img class="menu-logo" src="img/menu-logo.png"/></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
  
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav me-auto menu-elements">
          <li class="nav-item dropdown">
            <a class="nav-link menu-element dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-tools"></i></i> Zlecenia</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="kanban.php">Kanban</a>
              <a class="dropdown-item" href="contractList.php">Lista zleceń</a>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link menu-element" href="deviceList.php"><i class="fas fa-hdd"></i></i> Urządzenia</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link menu-element dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-building"></i> Klienci</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="companyList.php">Firmy</a>
              <a class="dropdown-item" href="companyUserList.php">Osoby klienta</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link menu-element dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> Ustawienia</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Pracownicy</a>
              <a class="dropdown-item" href="#">Firmy</a>
              <a class="dropdown-item" href="#">Zlecenia</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Moje konto</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link menu-element logout" href="logout.php"><i class="fas fa-sign-out-alt"></i>Wyloguj</a>
          </li>
        </ul>
        <form action="search_result.php" method="POST" class="d-flex">
          <input class="form-control me-sm-2" type="text" name = "contract_number" placeholder="Numer zlecenia">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </div>
  </nav>

<?php
}
?>