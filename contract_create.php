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
$company_user_id = $_POST['company_user_id'];
$description = $_POST['description'];
$employee_id = $_POST['employee_id'];
$priority = $_POST['priority'];
$device_id = $_POST['device_id'];

if($con->query("
    INSERT into contract (contract_number, phase_id, employee_id, company_id, company_user_id, description, priority, creation_date)
    SELECT dt, 1, $employee_id, $company_id, $company_user_id, '$description', $priority, CURRENT_TIMESTAMP()
    FROM (
        SELECT CONCAT('Z/', year(curdate()), '/', MAX(contract_id)+1) AS dt
        FROM contract)a
    "))
{

    if($con->query("UPDATE device SET contract_id = (SELECT MAX(contract_id) FROM contract) WHERE device_id = $device_id"))
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <i class="fas fa-check-circle"></i> <strong> Zlecenie zostało utworzone! </strong>
                </div>';
        $last_contract = $con->query("SELECT MAX(contract_id)as last_contract FROM contract");
        while($c = $last_contract->fetch_assoc())
        {
            $link = $c['last_contract'];
            header("Location: contractCard.php?id=$link");
        }
    }
}
else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			<i class="fas fa-times-circle"></i> <strong> Nie udało się utworzyć zlecenia! </strong>
			</div>';
    header("Location: kanban.php");
}
?>