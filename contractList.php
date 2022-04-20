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
<body id="contract-list">

<?php 
    include_once "menu.php"; 
    $user_type = $_SESSION['user_type'];
    if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
    unset($_SESSION['error']);
?>

    <table class="table table-responsive standard-list">
        <thead>
            <td>Numer zlecenia</td>
            <td>Faza</td>
            <td>Data utworzenia</td>
            <td>Osoba odpowiedzialna</td>
            <td>Firma</td>
            <td>Osoba klienta</td>
            <td>Priorytet</td>
            <td>Urządzenie</td>
            <td>Usuń</td>
        </thead>
        <tbody class="table-hover">
            <?php
            
                $contracts = $con->query('
                SELECT 
                    contract_id, 
                    contract_number, 
                    phase.name AS "phase", 
                    creation_date, 
                    CONCAT(employee.first_name, " ", employee.last_name) AS "employee", 
                    company.name AS "company", 
                    CONCAT(company_user.first_name, " ", company_user.last_name) AS "company_user", 
                    CASE 
                        WHEN priority = 1 THEN "1 (krytyczny)"
                        WHEN priority = 2 THEN "2 (pilny)"
                        WHEN priority = 3 THEN "3 (średni)"
                        WHEN priority = 4 THEN "4 (niski)"
                        WHEN priority = 5 THEN "5 (bardzo niski)"
                    END AS "priority",
                    device.serial_number as "serial_number"
                FROM contract 
                LEFT JOIN phase using (phase_id)
                LEFT JOIN company using (company_id)
                LEFT JOIN company_user using (company_user_id)
                LEFT JOIN employee using (employee_id)
                LEFT JOIN device using (contract_id)
                WHERE (CASE WHEN '.$user_type.' = 2 THEN contract.company_id = '.$_SESSION['company_id'].'
                ELSE true END)
                ORDER BY contract_id DESC
                ');
                
                while($contract = $contracts->fetch_assoc())
                {
                    echo '<tr class="table-light">
                        <td><a href="contractCard.php?id='.$contract['contract_id'].'">'.$contract['contract_number'].'</td>
                        <td>'.$contract['phase'].'</td>
                        <td>'.$contract['creation_date'].'</td>                        
                        <td>'.$contract['employee'].'</td>
                        <td>'.$contract['company'].'</td>
                        <td>'.$contract['company_user'].'</td>
                        <td>'.$contract['priority'].'</td>
                        <td>'.$contract['serial_number'].'</td>
                        <td><a href="delete.php?contract_id='.$contract['contract_id'].'"><i class="fas fa-backspace"></i></a>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    <a class="add-new" href="contractCard_new.php">+ Dodaj nowy</a>
    <?php include_once "footer.php" ?>
</body>
</html>