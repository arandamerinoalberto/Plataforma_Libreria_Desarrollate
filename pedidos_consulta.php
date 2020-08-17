<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>consulta pedidos</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/consultapedidos.js'></script>
	<script>
		//cargar todos los usuarios cuando se cargue la página
		window.onload=function() {
			consultaPedidos()

			//activar el botón consultar
			document.getElementById('consultar').onclick=enlaceMantenimiento
		}

		function enlaceMantenimiento() {
			//recuperar el checkbox que esté seleccionado
			var idpedido = document.querySelector('[name=pedido]:checked').value

			//alert(idpedido)

			//enlazar con la pantalla de mantenimiento pasando por la url el id del pedido

			window.location.href = `pedidos_mantenimiento.php?id=${idpedido}`;
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>CONSULTA PEDIDOS</h2>
	<!-- id='pedidos' para consultar la tabla de los pedidos -->
	<table id='pedidos'>
		<tr><th></th><th>PEDIDO</th><th>CLIENTE</th><th>IMPORTE</th><th>ESTADO DEL PEDIDO</th><th>LIBROS</th></tr>
		<!--tr><td><input type='radio' name='pedido' value=''></td><td>12345678A</td><td>Profesor</td><td>Maligno</td></tr-->
	</table><br><br>
	<center><input type="button" id='consultar' value='Consulta detalle'></center>
</body>
</html>