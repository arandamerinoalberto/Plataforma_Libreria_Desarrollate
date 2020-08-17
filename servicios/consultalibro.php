<?php
	//consulta de detalle de un libro con sus categorias
	$idlibro = $_POST['idlibro'];

	$sql = "SELECT * FROM libros WHERE idlibro = $idlibro";
	
	//conexión bbdd
	require 'bbdd/conexion.php';

	$resultado = mysqli_query($conexionLibreria, $sql) or die (mysqli_error($conexionLibreria));

	//array vacio para guardar los datos libro
	$libro = mysqli_fetch_assoc($resultado);

	//consultar las categorías del libro
	$sql = "SELECT idcategoria FROM libroscategorias WHERE idlibro = $idlibro";

	$resultado = mysqli_query($conexionLibreria, $sql) or die (mysqli_error($conexionLibreria));

	$categorias = [];

	while ($categoria = mysqli_fetch_assoc($resultado)) {
		array_push($categorias, $categoria['idcategoria']);
	}

	//json de respuesta
	echo json_encode(array($libro, $categorias));
?>