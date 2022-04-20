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
    $contract_id = $_GET['id'];
    $user_type = $_SESSION['user_type'];
    if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
    unset($_SESSION['error']);

    $contracts = $con->query('
        SELECT 
        contract_id, 
        contract_number, 
        phase.phase_id AS "phase_id",
        phase.name AS "phase", 
        creation_date, 
        description,
        CONCAT(employee.first_name, " ", employee.last_name) AS "employee", 
        company.company_id AS "company_id",
        company.name AS "company", 
        company_user.company_user_id AS "company_user_id",
        CONCAT(company_user.first_name, " ", company_user.last_name) AS "company_user", 
        priority,
        device.device_id AS "device_id",
        device.name AS "device_name",
        device.serial_number AS "serial_number"
        FROM contract 
        LEFT JOIN phase using (phase_id)
        LEFT JOIN company using (company_id)
        LEFT JOIN company_user using (company_user_id)
        LEFT JOIN employee using (employee_id)
        LEFT JOIN device using (contract_id)
        WHERE contract_id = '.$contract_id.'
        LIMIT 1
    ');
    while($contract = $contracts->fetch_assoc())
    {
    ?>
<div class="row">
    <div class="col-md-5 contract-form">
    <form id="edit_contract" method="POST" action="contract_save.php">
        <fieldset>
            <input type="hidden" name="contract_id" value="<?php echo $contract_id; ?>">
            <legend><?php echo $contract['contract_number']; ?></legend>
            <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Firma:</label>
                <select class="form-control selectpicker" data-live-search="true" id="exampleSelect1" name="company_id" 
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
                    <?php
                        $company = $con->query("SELECT company_id, name FROM company ORDER BY name");
                        while($c = $company->fetch_assoc())
                        {
                            if($c['company_id'] == $contract['company_id'])
                            {
                                echo '<option value="'.$c['company_id'].'" selected>'.$c['name'].'</option>';
                            }
                            else
                            {
                                echo '<option value="'.$c['company_id'].'">'.$c['name'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Urządzenie:</label>
                <select class="form-control selectpicker" data-live-search="true" id="exampleSelect1" name="device_id"
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
                    <option value="null"></option>
                    <?php
                        $device = $con->query("SELECT device_id, name, serial_number FROM device WHERE contract_id = $contract_id OR contract_id IS NULL ORDER BY name");
                        while($d = $device->fetch_assoc())
                        {
                            if($d['device_id'] == $contract['device_id'])
                            {
                                echo '<option value="'.$d['device_id'].'" selected>('.$d['serial_number'].') '.$d['name'].'</option>';
                            }
                            else
                            {
                                echo '<option value="'.$d['device_id'].'">('.$d['serial_number'].') '.$d['name'].'</option>';
                            }
                        }  
                    ?>
                </select>
                <small id="emailHelp" class="form-text text-muted">Można wskazać tylko urządzenia, które nie mają przypisanego zlecenia.</small>
            </div>

            <div class="form-group">
            <label for="exampleSelect1" class="form-label mt-4">Osoba klienta:</label>
            <select class="form-control selectpicker" data-live-search="true" id="exampleSelect1" name="company_user_id"
            <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
            <?php
                $company_user = $con->query("
                    SELECT DISTINCT cu.company_user_id AS cu_id, CONCAT(first_name, ' ', last_name) AS name, cu.email 
                    FROM company_user cu 
                    JOIN company c ON c.company_id = cu.company_id
                    JOIN contract co ON co.company_id = c.company_id
                    WHERE co.company_id = ".$contract['company_id']."
                    ORDER BY first_name");
                while($cu = $company_user->fetch_assoc())
                {
                    if($cu['cu_id'] == $contract['company_user_id'])
                    {
                        echo '<option value="'.$cu['cu_id'].'" selected>'.$cu['name'].'</option>';
                    }
                    else
                    {
                        echo '<option value="'.$cu['cu_id'].'">'.$cu['name'].'</option>';
                    }
                }
            ?>
            </select>
            </div>

            <div class="form-group">
                <label for="exampleTextarea" class="form-label mt-4">Opis problemu</label>
                <textarea class="form-control" id="exampleTextarea" name="description" rows="3"><?php echo $contract['description']; ?></textarea>
            </div>


            <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Serwisant:</label>
                <select class="form-control selectpicker" data-live-search="true" name="employee_id" id="exampleSelect2"
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
                    <option></option>
                    <?php
                    $phase = $con->query("SELECT employee_id, CONCAT(first_name, ' ', last_name) AS name FROM employee ORDER BY name");
                    while($em = $phase->fetch_assoc())
                    {
                        if($em['employee_id'] == $contract['employee_id'])
                        {
                            echo '<option value="'.$em['employee_id'].'" selected>'.$em['name'].'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$em['employee_id'].'">'.$em['name'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Faza:</label>
                <select class="form-control" name="phase_id" id="exampleSelect2"
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
                <?php
                    $phase = $con->query("SELECT phase_id, name FROM phase ORDER BY name");
                    while($ph = $phase->fetch_assoc())
                    {
                        if($ph['phase_id'] == $contract['phase_id'])
                        {
                            echo '<option value="'.$ph['phase_id'].'" selected>'.$ph['name'].'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$ph['phase_id'].'">'.$ph['name'].'</option>';
                        }
                    }
                ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleSelect1" class="form-label mt-4">Priorytet:</label>
                <select class="form-control" name="priority" id="exampleSelect3"
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
                <?php
                    $priority = $con->query("SELECT DISTINCT priority FROM contract ORDER BY priority");
                    while($p = $priority->fetch_assoc())
                    {
                        if($p['priority'] == $contract['priority'])
                        {
                            echo '<option value="'.$p['priority'].'" selected>'.$p['priority'].'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$p['priority'].'">'.$p['priority'].'</option>';
                        }
                    }
                ?>
                </select>
            </div>

            <div class="actions">
                <a href="kanban.php" class="btn btn-dark"><i class="fas fa-chevron-left"></i> powrót</a>
                <?php if($user_type <> 2) { ?>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> zapisz</button>
                <?php } ?>
            </div>
        </fieldset>
    </form>
    <?php 
    }
    ?>
    </div>

    <div class="col-md-5 contract-form">
        <form id="add_file" method="POST" enctype="multipart/form-data" action="file_add.php">
            <legend>Pliki</legend>
            <div class="form-group">
                <input type="hidden" name="contract_id" value="<?php echo $_GET['id']; ?>">
                <label for="formFile" class="form-label mt-4"> Załącznik</label>
                <input class="form-control" type="file" id="formFile" name="file"
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>>
                <small><i class="fas fa-info-circle"></i> Aby potwierdzić dodanie załącznika, użyj przycisku poniżej</small> <br>
                <button type="submit" class="btn btn-success"
                <?php if($user_type == 2) { ?> disabled="disabled" <?php } ?>><i class='fas fa-paperclip'></i> Dodaj</button>
            </div>
        </form>

        <div id="commission_images"> 
            <p>
                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Wyświetl dodane zdjęcia
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <?php
                    $images = $con->query("SELECT * FROM file WHERE contract_id = '$contract_id' ORDER BY upload_date");
                    while($image = $images->fetch_assoc())
                    {
                        echo '<img src=files/'.$image['file_name'].'> <br>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>

</body>
</html>