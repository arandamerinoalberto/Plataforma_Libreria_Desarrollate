<?php
	//recuperar los datos de la petición
	//FILTER_SANITIZE_ADD_SLASHES -> añadir escapes
	$nif = filter_input(INPUT_POST, 'nif');
	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES);
	$apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_ADD_SLASHES);
	$direccion = filter_input(INPUT_POST, 'direccion', FILTER_SANITIZE_ADD_SLASHES);
	$cp = filter_input(INPUT_POST, 'cp'); 
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$telefono = filter_input(INPUT_POST, 'telefono');

	//validar los datos
	try {
		$errores = '';

		if (!$nif) {
			//throw new Exception("Nif oblgatorio", 10);
			$errores.="Nif oblgatorio\n";
		}
		if (!$nombre) {
			//throw new Exception("Nombre oblgatorio", 10);
			$errores.="Nombre oblgatorio\n";
		}
		if (!$apellidos) {
			//throw new Exception("Apellidos oblgatorios", 10);
			$errores.="Apellidos oblgatorios\n";
		}
		if (!$direccion) {
			//throw new Exception("Dirección oblgatoria", 10);
			$errores.="Dirección oblgatoria\n";
		}
		if (!$cp) {
			//throw new Exception("CP oblgatorio", 10);
			$errores.="CP oblgatorio\n";
		}
		if (!$email) {
			//throw new Exception("Email oblgatorio o con formato incorrecto", 10);
			$errores.="Email oblgatorio o con formato incorrecto\n";
		}

		if (!$telefono) {
			//throw new Exception("Teléfono oblgatorio", 10);
			$errores.="Teléfono oblgatorio\n";
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
	$sql = "INSERT INTO usuarios VALUES (NULL, '$nif', '$nombre', '$apellidos', '$direccion', '$cp', '$email', '$telefono', DEFAULT)";

	//ejecutar la sentencia pero con tratamiento de errores
	if (mysqli_query($conexionLibreria, $sql)) {
		//si va bien:
		//recuperar el id que le ha asignado el sgbd al usuario
		//$id = mysqli_insert_id($conexionLibreria);

		$respuesta = ['00', 'Alta usuario efectuada'];
	} else {
		//si va mal:
		if (mysqli_errno($conexionLibreria) == 1062) {
			//nif duplicado
			$respuesta = ['20', 'Usuario ya existe en la base de datos'];
		} else {
			$respuesta = ['99', 'Insert 1:'.mysqli_error($conexionLibreria)];
		}
	}

	//respuesta del servidor
	echo json_encode($respuesta);

?>