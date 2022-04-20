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

<?php 
    include_once "menu.php"; 
    if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
    unset($_SESSION['error']);
?>

    <table class="table table-responsive standard-list">
        <thead>
            <td>Nazwa</td>
            <td>Nazwa skrócona</td>
            <td>NIP</td>
            <td>Adres główny</td>
            <td>Usuń</td>
        </thead>
        <tbody class="table-hover">
            <?php
            
                $companies = $con->query('
                SELECT c.company_id, c.name, c.short_name, c.NIP, CONCAT(a.street, ", ", a.zip_code, " ", a.city) AS "address"
                FROM company c
                LEFT JOIN address a ON a.company_id = c.company_id
                ORDER BY c.name');
                
                while($company = $companies->fetch_assoc())
                {
                    echo '<tr class="table-light">
                        <td>'.$company['name'].'</td>
                        <td>'.$company['short_name'].'</td>
                        <td>'.$company['NIP'].'</td>
                        <td>'.$company['address'].'</td>
                        <td><a href="delete.php?company_id='.$company['company_id'].'"><i class="fas fa-backspace"></i></a>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    <a class="add-new" href="company_new.php">+ Dodaj nowy</a>
    <?php include_once "footer.php" ?>
</body>
</html>