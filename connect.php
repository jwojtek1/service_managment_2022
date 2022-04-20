<?php

	$host = "localhost";
	$db_user = "root";
	$db_password = "";
	$db_name = "service_prod";

    $con = mysqli_connect($host, $db_user, $db_password, $db_name);

    if (mysqli_connect_errno())
    {
        echo "Nie można połączyć się z bazą danych: " . mysqli_connect_error();
    }

?>