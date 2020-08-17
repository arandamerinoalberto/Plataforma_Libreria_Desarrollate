<?php
	//consulta de pedidos

	//recuperar el id del pedido a consultar
	if (isset($_POST['idpedido'])) {
		//llamada desde la pantalla de consulta de detalle
		$id = $_POST['idpedido'];

		//consulta
		$sql = "SELECT * FROM pedidos WHERE idpedido = $id";
	} else {
		//llamada desde la pantalla de consulta de todos los pedidos
		//consulta
		$sql = "SELECT * FROM pedidos ORDER BY nombre" ;
	}

	//conexión bbdd
	require 'bbdd/conexion.php';

	$resultado = mysqli_query($conexionLibreria, $sql) or die (mysqli_error($conexionLibreria));

	//if (mysqli_num_rows($resultado) > 0) {
		//extraer los datos del pedido consultado

		//array vacio para guardar los pedidos
		$pedidos=[];

		//Obtener una fila como resultado de un array asociativo
		while($pedido = mysqli_fetch_assoc($resultado)) {
			//print_r($pedido);

			array_push($pedidos, $pedido);
		}
	//} else {
	//	echo 'No existen datos en la bbdd';
	//}

	//json de respuesta
	echo json_encode($pedidos);

?>