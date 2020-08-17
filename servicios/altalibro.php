<?php
	//recuperar los datos de la petición
	$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_ADD_SLASHES);
	$precio = filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT);
	$stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
	$idcategorias = json_decode(filter_input(INPUT_POST, 'idcat'));

	//validar los datos
	try {
		$errores = '';

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

	//alta del libro en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//activar transacción
	mysqli_autocommit($conexionLibreria, FALSE);

	try {
		//confeccionar sentencia sql alta libro
		$sql = "INSERT INTO libros VALUES (NULL, '$titulo', '$precio', '$stock', DEFAULT, DEFAULT)";

		if (!mysqli_query($conexionLibreria, $sql)) {
			if (mysqli_errno($conexionLibreria) == 1062) {
				//nif duplicado
				throw new Exception("Libro ya existe en la base de datos", 20);
			} else {
				throw new Exception(mysqli_error($conexionLibreria), 99);
			}
		}

		//dar de alta las relaciones libro/categoria
		//1. recuperar el id del libro que acabamos de insertar
		$idlibro = mysqli_insert_id($conexionLibreria);
		
		//2. dar de alta las relaciones
		if (!altaRelaciones($idlibro, $idcategorias)) {
			//deshacer los cambios
			//mysqli_rollback($conexionLibreria);

			throw new Exception("Ocurrió un error en el alta de libro", 99);
		}

	} catch (Exception $e) {
		$mensaje = $e->getMessage();
		$codigo = $e->getCode();

		//mensaje de respuesta de la petición
		$respuesta = [$codigo, $mensaje];
		echo json_encode($respuesta);
		return;
	}
	
	//trasladar los cambios de forma definitiva a la bbdd
	mysqli_commit($conexionLibreria);

	$respuesta = ['00', 'Libro dado de alta'];

	//respuesta del servidor
	echo json_encode($respuesta);

	function altaRelaciones($idlibro, $idcategorias) {
		//hacer visible la variable de conexion
		global $conexionLibreria;

		//insertar tantas filas como elementos tenga el array de categorias

		foreach ($idcategorias as $id) {
			//preparar sentencia sql
			$sql = "INSERT INTO libroscategorias VALUES ($idlibro, $id)";

			if (!mysqli_query($conexionLibreria, $sql)) {
				return false;
			}
		}

		return true; 
	}
?>