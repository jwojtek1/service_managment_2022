<?php

session_start();

if((!isset($_SESSION['logged'])) || (!isset($_POST['do'])))
{
	$_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-danger">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			  <i class="fas fa-times-circle"></i> <strong>Najpierw musisz się zalogować!
			</div>';
    header('Location: index.php');
}
	
require_once "connect.php";

$contract_id = $_POST['contract_id'];

// Ścieżka zapisu pliku
$targetDir = "files/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(!empty($_FILES["file"]["name"])){
    // Wybór dozwolonych rozszerzeń
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Wgraj plik na serwer
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Wprowadzenie do bazy danych
            $insert = $con->query("
            INSERT INTO file (file_name, upload_date, contract_id) 
            VALUES ('".$fileName."', CURRENT_TIMESTAMP(), $contract_id)");
            if($insert){
                $_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <i class="fas fa-check-circle"></i> <strong>Plik został dodany pomyślnie!
                        </div>';
                header('Location: contractCard.php?id='.$contract_id.'');
            }else{
                $_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <i class="fas fa-times-circle"></i> <strong>Nie udało się dodać pliku.
                        </div>';
                header('Location: contractCard.php?id='.$contract_id.'');
            } 
        }else{
            $_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <i class="fas fa-times-circle"></i> <strong>Wystąpił problem podczas wgrywania Twojego pliku. 
                        </div>';
            header('Location: contractCard.php?id='.$contract_id.'');
        }
    }else{
        $_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <i class="fas fa-exclamation-triangle"></i> <strong>Niestety, ale obsługujemy tylko następujące formaty: JPG, JPEG, PNG, GIF, PDF. <i class="fas fa-sad-cry"></i>
                        </div>';
        header('Location: contractCard.php?id='.$contract_id.'');
    }
}
else
{
    $_SESSION['error'] = '<div class="alert alert-dismissible fade show  alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <i class="fas fa-exclamation-triangle"></i> <strong> Musisz wybrać jakiś plik.
                        </div>';
    header('Location: contractCard.php?id='.$contract_id.'');
}

?>