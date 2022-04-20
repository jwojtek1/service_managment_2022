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
       require_once "connect.php";
       include_once "menu.php"; 
       if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
       unset($_SESSION['error']);
?>

<form id="create-device" action="device_new_backend.php" method="POST">
    <div class="form-group email">
        <label for="exampleInputEmail1" class="form-label">Numer seryjny</label>
        <input type="text" name="serial_number" class="form-control" required>
    </div>

    <div class="form-group email">
        <label for="exampleInputEmail1" class="form-label">Nazwa</label>
        <input type="text" name="device_name" class="form-control" required>
    </div>

    <!--<div class="form-group">
        <label for="exampleSelect1" class="form-label mt-4">Firma:</label>
        <select class="form-control selectpicker" id="exampleSelect1" name="company_id" data-live-search="true">
            <option></option>
            <?php
                /*$company = $con->query("SELECT company_id, name FROM company ORDER BY name");
                while($c = $company->fetch_assoc())
                {
                    echo '<option value="'.$c['company_id'].'">'.$c['name'].'</option>';
                }*/
            ?>
        </select>
    </div>-->
    <div class="actions">
        <a href="deviceList.php" class="btn btn-dark"><i class="fas fa-chevron-left"></i> powrót</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> zapisz</button>
    </div>
</form>
<?php include_once "footer.php" ?>

</body>
</html>