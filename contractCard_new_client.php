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
       if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
       unset($_SESSION['error']);
?>

                <form id="edit_contract" method="POST" action="contract_create_client.php">
                <fieldset>
                    <legend>Nowe zlecenie</legend>
                    
                    <div class="form-group">
                        <label for="exampleSelect1" class="form-label mt-4">Urządzenie:</label>
                        <select class="form-control selectpicker" data-live-search="true" id="exampleSelect1" name="device_id" required>
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
                        <textarea class="form-control" id="exampleTextarea" name="description" rows="3" required></textarea>
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