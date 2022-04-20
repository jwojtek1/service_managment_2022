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
       $user_type = $_SESSION['user_type'];
       if($user_type == 2) header("Location: contractCard_new_client.php");
       if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
       unset($_SESSION['error']);
?>

                <form id="edit_contract" method="POST" action="contract_create.php">
                <fieldset>
                    <legend>Nowe zlecenie</legend>
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
                        <label for="exampleSelect1" class="form-label mt-4">Osoba klienta:</label>
                        <select class="form-control selectpicker" data-live-search="true" id="exampleSelect1" name="company_user_id">
                            <?php
                                $company_user = $con->query("SELECT company_user_id, CONCAT(first_name, ' ', last_name) AS name FROM company_user ORDER BY name");
                                while($cu = $company_user->fetch_assoc())
                                {
                                    echo '<option value="'.$cu['company_user_id'].'">'.$cu['name'].'</option>';
                                }
                                
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Urządzenie:</label>
                        <select class="form-control selectpicker" data-live-search="true" id="exampleSelect1" name="device_id">
                            <option value="null"></option>
                            <?php
                                $device = $con->query("SELECT device_id, name, serial_number FROM device WHERE contract_id IS NULL ORDER BY name");
                                while($d = $device->fetch_assoc())
                                {
                                    echo '<option value="'.$d['device_id'].'">('.$d['serial_number'].') '.$d['name'].'</option>';
                                }
                                
                            ?>
                        </select>
                        <small id="emailHelp" class="form-text text-muted">Można wskazać tylko urządzenia, które nie mają przypisanego zlecenia.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleTextarea" class="form-label mt-4">Opis problemu</label>
                        <textarea class="form-control" id="exampleTextarea" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Serwisant:</label>
                        <select class="form-control selectpicker" data-live-search="true" name="employee_id" id="exampleSelect2">
                            <?php
                                $phase = $con->query("SELECT employee_id, CONCAT(first_name, ' ', last_name) AS name FROM employee ORDER BY name");
                                while($em = $phase->fetch_assoc())
                                {
                                    echo '<option value="'.$em['employee_id'].'">'.$em['name'].'</option>';
                                }
                                
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Priorytet:</label>
                        <select class="form-control" name="priority" id="exampleSelect3">
                            <option value="1">1 - krytyczny</option>';
                            <option value="2">2 - pilny</option>';
                            <option value="3" selected>3 - średni</option>';
                            <option value="4">4 - niski</option>';
                            <option value="5">5 - bardzo niski</option>';
                        </select>
                    </div>
                    <div class="actions">
                        <a href="kanban.php" class="btn btn-dark"><i class="fas fa-chevron-left"></i> powrót</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> zapisz</button>
                    </div>
                </fieldset>
                </form>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>

</body>
</html>