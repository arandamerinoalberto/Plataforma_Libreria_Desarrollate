<?php
	//recuperar los datos de la petición
	//FILTER_SANITIZE_ADD_SLASHES -> añadir escapes
	$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

	//validar los datos
	try {
		if (!$id) {
			throw new Exception("Informar pedido", 10);
		}
	} catch (Exception $e) {
		$mensaje = $e->getMessage();
		$codigo = $e->getCode();

		//mensaje de respuesta de la petición
		$respuesta = [$codigo, $mensaje];
		echo json_encode($respuesta);
		return; //para que no se ejecute la baja
	}

	//baja del pedido en la base de datos

	//fichero de conexion
	require 'bbdd/conexion.php';

	//confeccionar sentencia sql
	$sql = "DELETE FROM pedidos WHERE idpedido = $id";

	//ejecutar la sentencia pero con tratamiento de errores
	if (mysqli_query($conexionLibreria, $sql)) {
		$respuesta = ['00', 'Baja pedido efectuada'];
	} else {
		//si va mal:
		if (mysqli_errno($conexionLibreria) == 1451) {
			//registro no se puede dar de baja porque tiene una restricción de clave foránea
			$respuesta = ['20', 'Pedido no puede borrarse'];
		} else {
			$respuesta = ['99', 'Delete 1:'.mysqli_error($conexionLibreria)];
		}
	}

	//respuesta del servidor
	echo json_encode($respuesta);

?>