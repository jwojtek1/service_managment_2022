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
$name = $_POST['name'];
$short_name = $_POST['short_name'];
$nip = $_POST['nip'];
$street = $_POST['street'];
$zip_code = $_POST['zip_code'];
$city = $_POST['city'];
$province = $_POST['province'];
$country = $_POST['country'];



if($con->query("INSERT INTO company(name, short_name, nip) VALUES('$name', '$short_name', '$nip')"))
{
    if($con->query("INSERT INTO address(company_id, name, street, zip_code, city, province, country) VALUES((SELECT MAX(company_id) FROM company), 'adres główny', '$street','$zip_code', '$city', '$province', '$country')")) 
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fas fa-check-circle"></i> <strong> Klient został utworzony! </strong>
            </div>';
        header("Location: companyList.php");
    }
    else 
    {
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			<i class="fas fa-times-circle"></i> <strong> Nie udało się utworzyć adresu! </strong>
			</div>';
        header("Location: companyList.php");
    }
    
}

else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible fade show alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			<i class="fas fa-times-circle"></i> <strong> Nie udało się utworzyć klienta! </strong>
			</div>';
    header("Location: companyList.php");
}

?>