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
        <script src="js/bootstrap.bundle.min.js" ></script>
        <script src="https://kit.fontawesome.com/10a3451012.js" crossorigin="anonymous"></script>
    </head>
<body>

<?php 
include_once "menu.php";
header('Location: kanban.php');
include_once "footer.php"; 

?>

</body>
</html>