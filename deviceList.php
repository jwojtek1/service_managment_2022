<?php
    session_start();
    require_once "connect.php";
?>

<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Panel</title>
        <link rel="icon" type="image/png" href="img/favicon.ico"/>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/login_form.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="https://kit.fontawesome.com/10a3451012.js" crossorigin="anonymous"></script>
    </head>
<body>

<?php include_once "menu.php"; 
if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
unset($_SESSION['error']);
?>

    <table class="table table-striped standard-list">
        <thead>
            <td>Numer seryjny</td>
            <td>Nazwa</td>
            <td>Zlecenie</td>
            <td>Usuń</td>
        </thead>
        <tbody class="table-hover">
            <?php
            
                $devices = $con->query('
                SELECT * FROM device LEFT JOIN contract using(contract_id) ORDER BY name');
                
                while($d = $devices->fetch_assoc())
                {
                    echo '<tr class="table-light">
                        <td>'.$d['serial_number'].'</td>
                        <td>'.$d['name'].'</td>
                        <td><a href="contractCard.php?id='.$d['contract_id'].'">'.$d['contract_number'].'</td>
                        <td><a href="delete.php?device_id='.$d['device_id'].'"><i class="fas fa-backspace"></i></a>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    <a class="add-new" href="device_new.php">+ Dodaj nowy</a>
    <?php include_once "footer.php" ?>
</body>
</html>