<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mantenimiento pedidos</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/detallepedidos.js'></script>
	<script src='assets/js/bajapedidos.js'></script>
	<script src='assets/js/modificapedidos.js'></script>
	<script>
		//procesos a ejecutar cuando se carga la página
		window.onload=function() {
			//recuperar la url
			let url = window.location.href

			//posición que ocupa el ?
			let posicion = url.indexOf('?id');

			if (posicion == -1) {
				//acceso a la pantalla sin selección previa de un pedido
				window.location.href='pedidos_consulta.php';
			} else {
				//cortar la url por donde indica la posición + 4 (?id=)

				var idpedido = url.substring(posicion+4)
				
				//llamar a la función de consulta
				detallePedido(idpedido)

				//listener boton de modificacion
				document.getElementById('modi').onclick=modificapedido

				//listener boton de baja
				document.getElementById('baja').onclick=bajapedido

				//Asignar valor al input hidden
				document.getElementById('idpedido').value=idpedido;

			}
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>MODIFICACIÓN/BAJA PEDIDOS</h2>
	<form>
		<label>PEDIDO</label>
		<input type="text" id='pedido'><br>
		<label>NOMBRE</label>
		<input type="text" id='nombre'><br>
		<label>IMPORTE</label>
		<input type="text" id='importe'><br>
		<label>ESTADO</label>
		<input type="text" id='estado'><br>
		<label>FECHA ALTA</label>
		<input type="text" id='fechaalta'><br>
		<label>LIBROS</label>
		<input type="text" id='libros' required><br><br>
		<label><input type="button" id='consulta' value='Volver' onclick="javascript:window.location.href='pedidos_consulta.php'"></label>
		<input type="button" id='baja' value='Baja pedido'>
		<input type="button" id='modi' value='Modificación pedido'>
		<!--guardar el id del pedido en un campo oculto-->
		<input type="hidden" id='idpedido'>
	</form>
</body>
</html>