<?php
	//recuperar los datos de la petición
	//FILTER_SANITIZE_ADD_SLASHES -> añadir escapes
	$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES);
	$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_ADD_SLASHES);

	//validar los datos
	try {
		$errores = '';
		if (!$id) {
			throw new Exception("Informar categoria", 10);
		}
		if (!$nombre) {
			$errores.="Nombre oblgatorio\n";
		}
		if (!$descripcion) {
			$errores.="Descripcion oblgatoria\n";
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
		return; //para que no se ejecute la modificacion
	}

	//modificación del usuario en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//confeccionar sentencia sql
	$sql = "UPDATE categorias SET nombre='$nombre', descripcion='$descripcion' WHERE idcategoria = $id";

	//ejecutar la sentencia pero con tratamiento de errores
	if (mysqli_query($conexionLibreria, $sql)) {
		$respuesta = ['00', 'Modificación categoría efectuada'];
	} else {
		//si va mal:
		if (mysqli_errno($conexionLibreria) == 1062) {
			//nif duplicado
			$respuesta = ['20', 'Categoría ya existe en la base de datos'];
		} else {
			$respuesta = ['99', 'Update 1:'.mysqli_error($conexionLibreria)];
		}
	}

	//respuesta del servidor
	echo json_encode($respuesta);

?>