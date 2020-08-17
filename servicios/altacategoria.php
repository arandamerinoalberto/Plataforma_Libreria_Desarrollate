<?php
	//recuperar los datos de la petición
	//FILTER_SANITIZE_ADD_SLASHES -> añadir escapes
	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES);
	$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_ADD_SLASHES);

	//validar los datos
	try {
		$errores = '';

		if (!$nombre) {
			$errores.="Nombre oblgatorio\n";
		}
		if (!$descripcion) {
			$errores.="Descripción oblgatoria\n";
		}

		if ($errores!='') {
			throw new Exception($errores, 10);
		}
	} catch (Exception $e) {
		$mensaje = $e->getMessage();
		$codigo = $e->getCode();

		//mensaje de respuesta de la petición
		$respuesta = [$codigo, $mensaje];
		echo json_encode($respuesta);
		return; //para que no se ejecute el alta
	}

	//alta de la categoría en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//confeccionar sentencia sql
	$sql = "INSERT INTO categorias VALUES (NULL, '$nombre', '$descripcion')";

	//ejecutar la sentencia pero con tratamiento de errores
	if (mysqli_query($conexionLibreria, $sql)) {
		//si va bien:
		$respuesta = ['00', 'Alta categoría efectuada'];
	} else {
		//si va mal:
		if (mysqli_errno($conexionLibreria) == 1062) {
			//nif duplicado
			$respuesta = ['20', 'Categoría ya existe en la base de datos'];
		} else {
			$respuesta = ['99', 'Insert 1:'.mysqli_error($conexionLibreria)];
		}
	}

	//respuesta del servidor
	echo json_encode($respuesta);

?>