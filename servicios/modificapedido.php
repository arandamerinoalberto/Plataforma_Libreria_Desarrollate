<?php
	//recuperar los datos de la petición
	//FILTER_SANITIZE_ADD_SLASHES -> añadir escapes
	$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$pedido = filter_input(INPUT_POST, 'pedido', FILTER_SANITIZE_ADD_SLASHES);
	$nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_ADD_SLASHES);
	$importe = filter_input(INPUT_POST, 'importe'); 
	$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_ADD_SLASHES);
	$fechaalta = filter_input(INPUT_POST, 'fechaalta'); 
	$libros = filter_input(INPUT_POST, 'libros');

	//validar los datos
	try {
		$errores = '';
		if (!$id) {
			throw new Exception("Informar pedido", 10);
		}
		if (!$pedido) {
			//throw new Exception("Nombre oblgatorio", 10);
			$errores.="Pedido obligatorio\n";
		}
		if (!$nombre) {
			//throw new Exception("Nombre oblgatorio", 10);
			$errores.="Nombre oblgatorio\n";
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
			//throw new Exception("Libros oblgatorios", 10);
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
		return; //para que no se ejecute la modificacion
	}

	//modificación del pedido en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//confeccionar sentencia sql
	$sql = "UPDATE pedidos SET pedido='$pedido', nombre='$nombre', importe='$importe', estado='$estado', fechaalta='$fechaalta', libros='$libros' WHERE idpedido = $id";

	//ejecutar la sentencia pero con tratamiento de errores
	if (mysqli_query($conexionLibreria, $sql)) {
		$respuesta = ['00', 'Modificación pedido efectuada'];
	} else {
		//si va mal:
		if (mysqli_errno($conexionLibreria) == 1062) {
			//pedido duplicado
			$respuesta = ['20', 'Pedido ya existe en la base de datos'];
		} else {
			$respuesta = ['99', 'Update 1:'.mysqli_error($conexionLibreria)];
		}
	}

	//respuesta del servidor
	echo json_encode($respuesta);

?>