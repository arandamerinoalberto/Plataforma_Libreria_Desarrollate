<?php
	//consulta de usuarios

	//recuperar el id del usuario a consultar
	if (isset($_POST['idusuario'])) {
		//llamada desde la pantalla de consulta de detalle
		$id = $_POST['idusuario'];

		//consulta
		$sql = "SELECT * FROM usuarios WHERE idusuario = $id";
	} else {
		//llamada desde la pantalla de consulta de todos los usuarios
		//consulta
		$sql = "SELECT * FROM usuarios ORDER BY nombre, apellidos";
	}

	//conexión bbdd
	require 'bbdd/conexion.php';

	$resultado = mysqli_query($conexionLibreria, $sql) or die (mysqli_error($conexionLibreria));

	//if (mysqli_num_rows($resultado) > 0) {
		//extraer los datos del usuario consultado

		//array vacio para guardar los usuarios
		$usuarios=[];

		while($usuario = mysqli_fetch_assoc($resultado)) {
			//print_r($usuario);

			array_push($usuarios, $usuario);
		}
	//} else {
	//	echo 'No existen datos en la bbdd';
	//}

	//json de respuesta
	echo json_encode($usuarios);

?>