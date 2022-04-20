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
    session_start();
    require_once "connect.php";
    include_once "menu.php";
    if(isset($_SESSION['error'])) { echo $_SESSION['error']; }
    unset($_SESSION['error']);
?>

    <table class="table table-responsive standard-list">
        <thead>
            <td>Imię</td>
            <td>Nazwisko</td>
            <td>E-mail</td>
            <td>Firma</td>
            <td>Ostatnie logowanie</td>
            <td>Usuń</td>
        </thead>
        <tbody class="table-hover">
            <?php
            
                $company_users = $con->query('
                SELECT 
                    company_user_id,
                    first_name,
                    last_name,
                    email,
                    company.name,
                    last_time_login
                FROM company_user
                LEFT JOIN company using (company_id)');
                
                while($company_user = $company_users->fetch_assoc())
                {
                    echo '<tr class="table-light">
                        <td>'.$company_user['first_name'].'</td>
                        <td>'.$company_user['last_name'].'</td>
                        <td>'.$company_user['email'].'</td>
                        <td>'.$company_user['name'].'</td>
                        <td>'.$company_user['last_time_login'].'</td>
                        <td><a href="delete.php?company_user_id='.$company_user['company_user_id'].'"><i class="fas fa-backspace"></i></a>
                    </tr>
                    ';
                }
            ?>
        </tbody>
    </table>
    <a class="add-new" href="companyUser_new.php">+ Dodaj nowy</a>
    <?php include_once "footer.php" ?>
</body>
</html>