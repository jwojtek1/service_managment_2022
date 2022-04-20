<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Logowanie</title>
        <link rel="icon" type="image/png" href="img/favicon.ico"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-select.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/jquery.min.js" ></script>
        <script src="js/bootstrap-select.min.js" ></script>
        <script src="https://kit.fontawesome.com/10a3451012.js" crossorigin="anonymous"></script>
    </head>
<body id="login">
<?php
    session_start();
    if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
    unset($_SESSION['error']);
?>
<!--
    <img src="img/logo-management.png" class="center_img"/>
    <div class="center">
        <div id="panel">
            <form action="login_backend.php" method="POST">
                <legend class="legend">Zaloguj się</legend>
                <hr>
                <label for="username">Nazwa użytkownika:</label>
                <input type="text" id="username" name="username">
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password">
                <div id="lower">
                <input type="checkbox"><label class="check" for="checkbox">Zapamiętaj mnie!</label>
                <input type="submit" class="btn btn-primary" value="Login">
                </div>
            </form>
        </div>
    </div>
-->

<div class="container">
    <div class="row">
      <div class="col-lg-5 register">
          <div class="row">
            <div class="col-md-8 second">
              <h2>Logowanie</h2>
                <form action="login_backend.php" method="POST">
                  <div class="form-group email">
                    <label for="exampleInputEmail1" class="labelForm">Login</label>
                    <input type="text" name="username" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group password">
                    <label for="exampleInputPassword1" class="labelForm">Hasło</label>
                    <input type="password" name="password" class="form-control password" id="exampleInputPassword1">
                  </div>
                  <div class="form-group form-check terms">
                      <a class="login" href="register.php">Nie mam konta</a>
                    </label>
                  </div>
                  <button type="submit" class="btn btn-primary create">Zaloguj się</button>
                </form>
            </div>
          </div> 
      </div>
      <div class="col-lg-7 third">
        <h2>Witamy</h2>
        <p>W naszym panelu serwisowym możesz szybko zgłosić usterkę serwisowanego przez nas sprzętu. Nasz serwisant nie tylko zajmie się naprawą Twojego sprzętu, ale również jego odbiorem oraz dostarczeniem go po wykonaniu naprawy.</p> 
        <p>Serwis od A do Z. Dojazd na terenie Poznania i okolic (10km) w cenie!</p>
      </div>
    </div>
  </div>

  <?php include_once "footer.php" ?>
</body>
</html>
