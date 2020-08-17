<?php
	//recuperar los datos de la petición
	$idlibro = filter_input(INPUT_POST, 'idlibro', FILTER_VALIDATE_INT);
	$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_ADD_SLASHES);
	$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
	$stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
	$idcategorias = json_decode(filter_input(INPUT_POST, 'idcat'));

	//validar los datos
	try {
		$errores = '';
		if (!$idlibro) {
			throw new Exception('se debe seleccionar un libro previamente', 10);
		}
		if (!$titulo) {
			$errores.="Título obligatorio\n";
		}
		if (!$precio) {
			$errores.="Precio obligatorio\n";
		}
		if (!$stock) {
			$errores.="Stock obligatorio o con formato incorrecto\n";
		}
		if (!$idcategorias) {
			$errores.="Se debe seleccionar al menos una categoría\n";
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

	//echo json_encode(array('00', 'ok'));
	//return;

	//modificación del libro en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//activar transacción
	mysqli_autocommit($conexionLibreria, FALSE);

	try {
		//modificar la tabla de libros
		$sql = "UPDATE libros SET titulo='$titulo', stock='$stock', precio='$precio' WHERE idlibro = $idlibro";

		if (!mysqli_query($conexionLibreria, $sql)) {
			if (mysqli_errno($conexionLibreria) == 1062) {
				throw new Exception("Libro ya existe", 20);
			} else {
				throw new Exception(mysqli_error($conexionLibreria), 99);
			}
		}

		//borrar la tabla de relación 
		$sql = "DELETE FROM libroscategorias WHERE idlibro=$idlibro";

		if (!mysqli_query($conexionLibreria, $sql)) {
			throw new Exception(mysqli_error($conexionLibreria), 99);
		}

		//insertar las categorias del formulario en la tabla
		foreach ($idcategorias as $idcategoria) {
			$sql = "INSERT INTO libroscategorias VALUES ($idlibro, $idcategoria)";

			if (!mysqli_query($conexionLibreria, $sql)) {
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
	mysqli_commit($conexionLibreria);

	//confeccionar la respuesta 
	$respuesta = ['00', 'modificación efectuada'];

	echo json_encode($respuesta);
?>