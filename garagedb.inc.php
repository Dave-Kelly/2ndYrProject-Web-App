
<?php
	$hostname = "localhost";
	$username = "gddk";
	$password = "gerdimdavkar16";
	
	$dbname = "Garage";
	
	$con = mysqli_connect($hostname,$username,$password,$dbname);
	
	
	if(!$con)
	{
		echo "Failed to connect to MYSQL;" . mysqli_connect_error();
	}
?>