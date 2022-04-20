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
        <script src="js/jquery.min.js" ></script>
        <script src="js/bootstrap-select.min.js" ></script>
        <script src="https://kit.fontawesome.com/10a3451012.js" crossorigin="anonymous"></script>
    </head>
<body>

<?php
       session_start();
       include_once "menu.php";
       require_once "connect.php";
       if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
       unset($_SESSION['error']);
?>

<form id="create-company" action="company_new_backend.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Nazwa</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Nazwa skrócona</label>
                <input type="text" name="short_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" maxlength="10" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Ulica</label>
                <input type="text" name="street" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Kod pocztowy</label>
                <input type="text" name="zip_code" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Miasto</label>
                <input type="text" name="city" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Województwo</label>
                <input type="text" name="province" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Kraj</label>
                <input type="text" name="country" class="form-control" required>
            </div>
        </div>
    </div>
            <div class="actions">
                <a href="deviceList.php" class="btn btn-dark"><i class="fas fa-chevron-left"></i> powrót</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> zapisz</button>
            </div>
</form>
<?php include_once "footer.php" ?>
</body>
</html>