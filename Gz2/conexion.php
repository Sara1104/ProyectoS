<?php 
	
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'Gz2';

	$conection = @mysqli_connect($host,$user,$password,$db);
    
	if(!$conection){
		echo "Error en la conexión";
	}

?>