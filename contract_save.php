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

$contract_id = $_POST['contract_id'];
$company_id = $_POST['company_id'];
$company_user_id = $_POST['company_user_id'];
$description = $_POST['description'];
$employee_id = $_POST['employee_id'];
$phase_id = $_POST['phase_id'];
$priority = $_POST['priority'];
$device_id = $_POST['device_id'];

if($con->query("
    UPDATE contract
    SET 
        company_id = '$company_id', 
        company_user_id = '$company_user_id', 
        description = '$description', 
        employee_id = '$employee_id',
        phase_id = '$phase_id', 
        priority = '$priority'
    WHERE contract_id = $contract_id
    ")) 
{

    if($con->query("
        UPDATE device 
        SET contract_id = NULL
        WHERE contract_id = $contract_id
    "))
    {
        if($con->query("
            UPDATE device 
            SET contract_id = $contract_id
            WHERE device_id = $device_id
        "))
        {
            $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">                    
                    <i class="fas fa-check-circle"></i> <strong>Edycja przebiegła pomyślnie!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    </div>';
            header('Location: contractCard.php?id='.$contract_id.'');
        }
    }

}

else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
			  <i class="fas fa-times-circle"></i> <strong>Edycja nie powiodła się!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			</div>';
    header('Location: contractCard.php?id='.$contract_id.'');
}