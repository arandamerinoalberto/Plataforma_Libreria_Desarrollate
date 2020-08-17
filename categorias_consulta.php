<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>consulta categorias</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/consultacategorias.js'></script>
	<script>
		//cargar todas los categorías cuando se cargue la página
		window.onload=function() {
			consultaCategorias('T')

			//activar el botón consultar
			document.getElementById('consultar').onclick=enlaceMantenimiento
		}

		function enlaceMantenimiento() {
			//recuperar el checkbox que esté seleccionado
			var idcategoria = document.querySelector('[name=categoria]:checked').value

			//enlazar con la pantalla de mantenimiento pasando por la url el id de la catagoria
			window.location.href = `categorias_mantenimiento.php?id=${idcategoria}`;
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>CONSULTA CATEGORIAS</h2>
	<table id='categorias'>
		<tr><th></th><th>NOMBRE</th><th>DESCRIPCION</th></tr>
		<!--tr><td><input type='radio' name='categoria' value=''></td><td>Ciencia Ficción</td><td>Descripción de la categoría</td></tr-->
	</table><br><br>
	<center><input type="button" id='consultar' value='Consulta detalle'></center>
</body>
</html>