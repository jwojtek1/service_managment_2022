<?php

	session_start();
	
	session_unset();
	$_SESSION['error'] = '<div class="alert alert-success alert-dismissible fade show">
	  <i class="fas fa-check-circle"></i> <strong>Udało się!</strong> Pomyślnie wylogowano z serwisu.
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
	</div>
	';
	header('Location: index.php');

?>