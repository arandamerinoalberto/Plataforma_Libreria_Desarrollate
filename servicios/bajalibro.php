<?php
	//recuperar los datos de la petición
	$idlibro = filter_input(INPUT_POST, 'idlibro', FILTER_VALIDATE_INT);
	
	//validar los datos
	try {
		$errores = '';
		if (!$idlibro) {
			throw new Exception('se debe seleccionar un libro previamente', 10);
		}
	} catch (Exception $e) {
		$mensaje = $e->getMessage();
		$codigo = $e->getCode();

		//mensaje de respuesta de la petición
		$respuesta = [$codigo, $mensaje];
		echo json_encode($respuesta);
		return; //para que no se ejecute el alta
	}

	//baja del libro en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//activar transacción
	//mysqli_autocommit($conexionLibreria, FALSE);

	try {
		//baja de la tabla de libros
		$sql = "DELETE FROM libros WHERE idlibro = $idlibro";

		if (!mysqli_query($conexionLibreria, $sql)) {
			if (mysqli_errno($conexionLibreria) == 1451) {
				throw new Exception("Libro no se puede borrar", 20);
			} else {
				throw new Exception(mysqli_error($conexionLibreria), 99);
			}
		}
	} catch (Exception $e) {
		//recuperar el código y el mensaje de las excepciones
		$codigo = $e->getCode();
		$mensaje = $e->getMessage();

		//confeccionar el mensaje de respuesta
		$respuesta = [$codigo, $mensaje];

		//enviar el json de respuesta
		echo json_encode($respuesta);
		return;
	}

	//trasladar los cambios realizados a la bbdd
	//mysqli_commit($conexionLibreria);

	//confeccionar la respuesta 
	$respuesta = ['00', 'baja efectuada'];

	echo json_encode($respuesta);
?>