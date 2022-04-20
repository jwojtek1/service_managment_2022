<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Panel</title>
        <link rel="icon" type="image/png" href="img/favicon.ico"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap-select.min.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap-select.min.js" ></script>
        <script src="https://kit.fontawesome.com/10a3451012.js" crossorigin="anonymous"></script>
    </head>

<body id="register">

  <div class="container">
    <div class="row">
      <div class="col-lg-5 register">
          <div class="row">
            <div class="col-md-8 second">
              <h2>Rejestracja</h2>
                <form action="register_backend.php" method="POST">
                  <div class="form-group email">
                    <label for="exampleInputEmail1" class="labelForm">Imię</label>
                    <input type="text" name="first_name" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="form-group email">
                    <label for="exampleInputEmail1" class="labelForm">Nazwisko</label>
                    <input type="text" name="last_name" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="form-group email">
                    <label for="exampleInputEmail1" class="labelForm">Adres e-mail</label>
                    <input type="email" name="email" class="form-control email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="form-group password">
                    <label for="exampleInputPassword1" class="labelForm">Hasło</label>
                    <input type="password" name="password" class="form-control password" id="password" minlength="8" required>
                  </div>
                  <div class="form-group passwordConfirm">
                    <label for="exampleInputPassword1" class="labelForm">Powtórz hasło</label>
                    <input type="password" name="confirmPassword" class="form-control password" id="confirmPassword" minlength="8" required>
                    <span id='message'></span>
                  </div>
                  <div class="form-group form-check terms">
                    <input type="checkbox" class="form-check-input terms" id="exampleCheck1" required>
                    <label class="form-check-label terms" for="exampleCheck1">Akceptuję regulamin 
                      <a class="terms" href="regulamin.html">czytaj</a>
                      <a class="login" href="index.php">Posiadam już konto</a>
                    </label>
                  </div>
                  <button type="submit" id="account_create" class="btn btn-primary create">Utwórz konto</button>
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

  <script>
$('#password, #confirmPassword').on('keyup', function () {
  if ($('#password').val() == $('#confirmPassword').val()) {
    $('#message').html('Hasła są takie same.').css('color', 'green');
  } else 
    $('#message').html('Hasła różnią się od siebie.').css('color', 'red');
    $('#account_create').prop('disabled', true);
    $('#account_create')
});
</script>
</body>
</html>