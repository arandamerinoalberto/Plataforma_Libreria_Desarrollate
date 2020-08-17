<?php
	//conexión a la base de datos
	//host, usuario, password, base de datos
	$conexionLibreria = mysqli_connect('localhost', 'root', '', 'libreria_2') or die("hubo un error al conectar con la base de datos");

	//juego de caracteres a utilizar en la conexión
	mysqli_set_charset($conexionLibreria, "utf8");
?>