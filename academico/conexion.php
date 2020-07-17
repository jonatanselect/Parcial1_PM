<?php 

	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'academico';
	//en la variable conection se almacena el db
	$conection =@mysqli_connect($host,$user,$password,$db);
	if(!$conection){
		echo "error de conexion";
	}
	

 ?>