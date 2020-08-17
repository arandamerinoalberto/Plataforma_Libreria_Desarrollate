<?php
	//recuperar los datos de la petición
	/*$idpedido = filter_input(INPUT_POST, 'idpedido', FILTER_VALIDATE_INT);*/
	$pedido = filter_input(INPUT_POST, 'pedido', FILTER_SANITIZE_ADD_SLASHES);
	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES);
	$importe = filter_input(INPUT_POST, 'importe', FILTER_VALIDATE_FLOAT);
	$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_ADD_SLASHES);
	$fechaalta = filter_input(INPUT_POST, 'fechaalta');
	$libros = filter_input(INPUT_POST, 'libros', FILTER_SANITIZE_ADD_SLASHES);

//validar los datos
	try {
		$errores = '';

		if (!$pedido) {
			//throw new Exception("Nombre oblgatorio", 10);
			$errores.="Pedido obligatorio\n";
		}
		if (!$nombre) {
			//throw new Exception("Nombre oblgatorio", 10);
			$errores.="Nombre obligatorio\n";
		}
		if (!$importe) {
			//throw new Exception("Apellidos oblgatorios", 10);
			$errores.="Importe obligatorios\n";
		}
		if (!$estado) {
			//throw new Exception("Dirección oblgatoria", 10);
			$errores.="Estado obligatorio\n";
		}
		if (!$fechaalta) {
			//throw new Exception("CP oblgatorio", 10);
			$errores.="Fecha alta obligatoria\n";
		}
		if (!$libros) {
			//throw new Exception("CP oblgatorio", 10);
			$errores.="Libros obligatorios\n";
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

	//alta del usuario en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//confeccionar sentencia sql
	$sql = "INSERT INTO pedidos VALUES (NULL,'$pedido','$nombre', '$importe', '$estado', DEFAULT, '$libros', NULL)";


	//ejecutar la sentencia pero con tratamiento de errores
	if (mysqli_query($conexionLibreria, $sql)) {
		//si va bien:
		//recuperar el id que le ha asignado el sgbd al usuario
		//$id = mysqli_insert_id($conexionLibreria);

		$respuesta = ['00', 'Alta pedido efectuada'];
	} else {
		//si va mal:
		if (mysqli_errno($conexionLibreria) == 1062) {
			//nif duplicado
			$respuesta = ['20', 'Pedido ya existe en la base de datos'];
		} else {
			$respuesta = ['99', 'Insert 1:'.mysqli_error($conexionLibreria)];
		}
	}

	//respuesta del servidor
	echo json_encode($respuesta);

?>