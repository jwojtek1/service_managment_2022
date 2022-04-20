<?php
session_start();
if((!isset($_SESSION['logged'])) || (!isset($_POST['do'])))
{
	$_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Najpierw się zaloguj! </strong>
            </div>';
    header('Location: index.php');
}
	
require_once "connect.php";
$company_id = $_GET['company_id'];
$contract_id = $_GET['contract_id'];
$device_id = $_GET['device_id'];
$company_user_id = $_GET['company_user_id'];

if(isset($company_id)) 
{
    if($con->query("DELETE FROM company WHERE company_id = $company_id"))
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Firma została usunięta! </strong>
            </div>';
            header("Location: companyList.php");
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Nie udało się usunąć firmy! </strong>
            </div>';
            header("Location: companyList.php");
    }

}

elseif(isset($contract_id)) 
{
    if($con->query("UPDATE device SET contract_id = null WHERE contract_id = $contract_id"))
    {
        if($con->query("DELETE FROM contract WHERE contract_id = $contract_id"))
        {
            $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <i class="fas fa-times-circle"></i> <strong> Zlecenie zostało usunięte! </strong>
                </div>';
            header("Location: contractList.php");
        }
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Nie udało się usunąć zlecenia! </strong>
            </div>';
            header("Location: contractList.php");
    }
}

elseif(isset($device_id)) 
{
    if($con->query("DELETE FROM device WHERE device_id = $device_id"))
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Urządzenie zostało usunięte! </strong>
            </div>';
            header("Location: deviceList.php");
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Nie udało się usunąć urządzenia! </strong>
            </div>';
            header("Location: deviceList.php");
    }
}

elseif(isset($company_user_id)) 
{
    if($con->query("DELETE FROM company_user WHERE company_user_id = $company_user_id"))
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Osoba klienta zostało usunięta! </strong>
            </div>';
            header("Location: companyUserList.php");
    }
    else
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-times-circle"></i> <strong> Nie udało się usunąć oosby klienta! </strong>
            </div>';
            header("Location: companyUserList.php");
    }
}