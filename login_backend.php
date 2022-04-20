<?php
	//Rozpoczęcie sesji
	session_start();
	
	//Przekierowanie użytkownika do panelu logowania, jeśli nie wpisano loginu lub hasła
	if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}

	//Połączenie z bazą danych
	require_once "connect.php";

	//Przypisanie do zmiennych wartości z formularza
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
	
	//Obsługa wpisania w formularzu znaczników HTML
	$username = htmlentities($username, ENT_QUOTES, "UTF-8");
	$password = htmlentities($password, ENT_QUOTES, "UTF-8");

	//Weryfikacja istnienia w bazie danego pracownika
	if ($result = $con->query(
	sprintf("SELECT * FROM employee WHERE email='%s' AND password='%s'",
	mysqli_real_escape_string($con,$username),
	mysqli_real_escape_string($con,$password))))
	{
		$users = $result->num_rows;
		if($users>0)
		{
			//Przypisanie zmiennych sesyjnych
			$row = $result->fetch_assoc();
			$_SESSION['logged'] = true;
			$_SESSION['user_type'] = 1;
			$_SESSION['company_id'] = 0;
			$_SESSION['employee_id'] = $row['employee_id'];
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['email'] = $row['email'];
			
			unset($_SESSION['error']);
			$result->free_result();
			header('Location: panel.php');
			
		} 
		
		//Weryfikacja istnienia w bazie danego klienta
	elseif ($result = $con->query(
		sprintf("SELECT * FROM company_user WHERE email='%s' AND password='%s'",
		mysqli_real_escape_string($con,$username),
		mysqli_real_escape_string($con,$password))))
		{
			$users = $result->num_rows;
			if($users>0)
			{
				//Przypisanie zmiennych sesyjnych
				$row = $result->fetch_assoc();
				$_SESSION['logged'] = true;
				$_SESSION['user_type'] = 2;
				$_SESSION['company_id'] = $row['company_id'];
				$_SESSION['company_user_id'] = $row['company_user_id'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				$_SESSION['email'] = $row['email'];
				
				unset($_SESSION['error']);
				$result->free_result();
				header('Location: panel.php');
				
			} else {
				
				//Wyświetlenie komunikatu, jeśli login z odpowiadającym hasłem nie został odnaleziony
				$_SESSION['error'] = '<div class="alert alert-danger alert-dismissible fade show">
				  <i class="fas fa-times-circle"></i> <strong>Nieprawidłowy login lub hasło</strong> Spróbuj jeszcze raz.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				</div>';
				header('Location: index.php');
			}
			
		}

		else 
		{
			//Wyświetlenie komunikatu, jeśli login z odpowiadającym hasłem nie został odnaleziony
			$_SESSION['error'] = '<div class="alert alert-danger alert-dismissible fade show">
			  <i class="fas fa-times-circle"></i> <strong>Nieprawidłowy login lub hasło!</strong> Spróbuj jeszcze raz.
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			</div>';
			header('Location: index.php');
			
		}
		
	}

		$con->close();
	
?>