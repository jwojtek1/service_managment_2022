<?php
session_start();

if((!isset($_SESSION['logged'])) || (!isset($_POST['do'])))
{
	$_SESSION['error'] = '<div class="alert alert-dismissible alert-danger">
			  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			  <i class="fas fa-times-circle"></i> <strong>Najpierw musisz się zalogować!
			</div>';
    header('Location: index.php');
}
	
require_once "connect.php";

$company_id = $_POST['company_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);

if($con->query("
    INSERT INTO company_user(company_id, first_name, last_name, email, password)
    VALUES ($company_id, '$first_name', '$last_name', '$email', '$password')
"))
{

    $_SESSION['error'] = '<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-check-circle"></i> <strong> Osoba klienta została utworzona! </strong>
            </div>';
    header("Location: companyUserList.php");
}
else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			<i class="fas fa-times-circle"></i> <strong> Nie udało się utworzyć osoby klienta! </strong>
			</div>';
    header("Location: companyUserList.php");
}
?>