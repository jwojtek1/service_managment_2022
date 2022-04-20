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
$serial_number = $_POST['serial_number'];
$device_name = $_POST['device_name'];

if($con->query("INSERT INTO device(serial_number, name) VALUES('$serial_number', '$device_name')"))
{
    $_SESSION['error'] = '<div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <i class="fas fa-check-circle"></i> <strong> Urządzenie zostało utworzone! </strong>
            </div>';
    header("Location: deviceList.php");
}

else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible alert-danger">
			  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			  <i class="fas fa-times-circle"></i> <strong> Nie udało się utworzyć urządzenia! </strong>
			</div>';
    header("Location: deviceList.php");
}

?>