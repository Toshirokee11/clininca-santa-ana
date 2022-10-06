<?php
	//Sintaxis de conexión de la base de datos de muestra para PHP y MySQL.
	
	//Conectar a la base de datos
	
	$hostname="localhost";
	$username="root";
	$password="";
	$dbname="id16889661_root";
	
	$con = mysqli_connect($hostname,$username, $password, $dbname);
	if (!$con){
        echo "Falló la conexión a la base de datos.";
    }
?>