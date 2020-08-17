<?php
	//paginacion -ini-
	$libros_a_mostrar = 5;
	//$libro_inicial = 0; 

	//                nùmero de pàgina      
	$libro_inicial = ($_POST['pag']-1) * $libros_a_mostrar;
	//paginacion -fin-

	//consulta de todos los libros ordenados por titulo
	$ordenacion = 'titulo';
	
	//paginacion -ini-
	//$sql = "SELECT * FROM libros ORDER BY titulo";
	$sql = "SELECT * FROM libros ORDER BY $ordenacion LIMIT $libro_inicial, $libros_a_mostrar";
	//paginacion -fin-
	
	//conexión bbdd
	require 'bbdd/conexion.php';

	$resultado = mysqli_query($conexionLibreria, $sql) or die (mysqli_error($conexionLibreria));

	//array vacio para guardar los libros
	$libros=[];

	while($libro = mysqli_fetch_assoc($resultado)) {
		//print_r($libro);

		array_push($libros, $libro);
	}

	//paginacion -ini-
	//consultar el número total de registros de la tabla
	$sql = "SELECT COUNT(*) AS numregistros FROM libros";

	$resultado = mysqli_query($conexionLibreria, $sql) or die(mysqli_error($conexionLibreria));

	$fila = mysqli_fetch_assoc($resultado);

	$numregistros = $fila['numregistros'];

	//calcular el número de páginas que necesitamos para mostrar todos los libros
	$numpaginas = ceil($numregistros/$libros_a_mostrar);
	//paginacion -fin-

	//json de respuesta

	//paginacion -ini-
	//echo json_encode($libros);

	//devolver un array donde el primer elemento es la lista de libros y el segundo elemento el número de páginas
	echo json_encode(array($libros, $numpaginas));
	//paginacion -fin-
?>