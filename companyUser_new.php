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

<form id="create-company" action="companyUser_new_backend.php" method="POST">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Firma:</label>
                <select class="form-control selectpicker" id="exampleSelect1" name="company_id" data-live-search="true">
                    <?php
                        $company = $con->query("SELECT company_id, name FROM company ORDER BY name");
                        while($c = $company->fetch_assoc())
                        {
                            echo '<option value="'.$c['company_id'].'">'.$c['name'].'</option>';
                            }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Imię</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Nazwisko</label>
                <input type="text" name="last_name" class="form-control" maxlength="10" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">E-mail</label>
                <input type="text" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Hasło</label>
                <input type="password" name="password" class="form-control" required>
            </div>

        </div>
    </div>
    <div class="actions">
        <a href="companyUserList.php" class="btn btn-dark"><i class="fas fa-chevron-left"></i> powrót</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> zapisz</button>
    </div>
</form>
<?php include_once "footer.php" ?>
</body>
</html>