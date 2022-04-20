<?php

require_once "connect.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);

if($con->query("INSERT INTO company(name, short_name, NIP) VALUES (CONCAT('$first_name', ' ', '$last_name'), CONCAT(LEFT('$first_name', 1), LEFT('$last_name', 1)), '0000000000')"))
{
    if($con->query("INSERT INTO company_user(company_id, first_name, last_name, email, password) VALUES ((SELECT MAX(company_id) FROM company), '$first_name', '$last_name','$email', '$password')"))
    $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-check-circle"></i> <strong> Udało się pomyślnie zarejestrować! Możesz się teraz zalogować.
            </div>';
    header("Location: index.php");
}
else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
			  <i class="fas fa-times-circle"></i> <strong> Błąd podczas rejestracji. Skontaktuj się z administatorem serwisu.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			</div>';
    header("Location: index.php");
}

?>