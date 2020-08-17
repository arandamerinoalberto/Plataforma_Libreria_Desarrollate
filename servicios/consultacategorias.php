<?php
	//consulta de categorias

	//recuperar el id de la categoria a consultar
	if (isset($_POST['idcategoria'])) {
		//llamada desde la pantalla de consulta de detalle
		$id = $_POST['idcategoria'];

		//consulta
		$sql = "SELECT * FROM categorias WHERE idcategoria = $id";
	} else {
		//llamada desde la pantalla de consulta de todos lqs categorias
		//consulta
		$sql = "SELECT * FROM categorias ORDER BY nombre";
	}

	//conexión bbdd
	require 'bbdd/conexion.php';

	$resultado = mysqli_query($conexionLibreria, $sql) or die (mysqli_error($conexionLibreria));

	//if (mysqli_num_rows($resultado) > 0) {

		//array vacio para guardar las categorias
		$categorias=[];

		while($categoria = mysqli_fetch_assoc($resultado)) {
			//print_r($categoria);

			array_push($categorias, $categoria);
		}
	//} else {
	//	echo 'No existen datos en la bbdd';
	//}

	//json de respuesta
	//sleep(3);
	echo json_encode($categorias);

?>