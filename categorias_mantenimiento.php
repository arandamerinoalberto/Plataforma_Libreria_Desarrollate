<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>mantenimiento categorias</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/detallecategoria.js'></script>
	<script src='assets/js/bajacategorias.js'></script>
	<script src='assets/js/modificacategorias.js'></script>
	<script>
		//procesos a ejecutar cuando se carga la página
		window.onload=function() {
			//recuperar la url
			let url = window.location.href

			//posición que ocupa el ?
			let posicion = url.indexOf('?id');

			if (posicion == -1) {
				//acceso a la pantalla sin selección previa de un usuario
				window.location.href='categorias_consulta.php';
			} else {
				//cortar la url por donde indica la posición + 4 (?id=)

				var idcategoria = url.substring(posicion+4)
				
				//llamar a la función de consulta
				detalleCategoria(idcategoria)

				//listener boton de modificacion
				document.getElementById('modi').onclick=modificacategoria

				//listener boton de baja
				document.getElementById('baja').onclick=bajacategoria
			}
		}
		
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>MODIFICACIÓN/BAJA CATEGORIAS</h2>
	<form>
		<label>NOMBRE</label>
		<input type="text" id='nombre'><br>
		<label>DESCRIPCION</label>
		<textarea id='descripcion' cols="20" rows="5"></textarea>
		<br><br>
		<label><input type="button" id='consulta' value='Volver' onclick="javascript:window.location.href='categorias_consulta.php'"></label>
		
		<input type="button" id='baja' value='Baja categoría'>
		<input type="button" id='modi' value='Modificación'>
		<!--guardar el id de la categoria en un campo oculto-->
		<input type="hidden" id='idcategoria'>
	</form>
</body>
</html>