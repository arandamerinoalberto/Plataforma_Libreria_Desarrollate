<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta pedidos</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/altapedido.js'></script>
	<script>
		//activar el listener del botón de alta
		window.onload=function() {
			//cargar las categorías disponibles cuando se carga la página
			//consultaPedidos('P')

			//listener botón alta pedido
			document.getElementById('formulario').onsubmit=function() {
					//desactivar el comportamiento por defecto
					event.preventDefault()

					altapedido()
				}
		}

	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>ALTA PEDIDOS</h2>
	<form id='formulario'>
		<label>PEDIDO</label>
		<input type="text" id='pedido' required><br>
		<label>CLIENTE</label>
		<input type="text" id='nombre' required><br>
		<label>IMPORTE</label>
		<input type="number" id='importe' step='0.01' required><br>
		<label>ESTADO</label>
		<!-- <input type="text" id='estado' required><br> -->
		<select id='estado' required>
			<option disabled selected value="0">Seleccione estado de pedido</option>
			<option id="pediente" value="Pediente" required>Pediente de envío</option>
  			<option id="preparado" value="Preparando envío" required>Preparando envío</option>
  			<option id="proceso" value="En proceso de envío" required>En proceso de envío</option>
 			<option id="enviado" value="Enviado" required>Enviado</option>
 			<option id="entregado" value="Entregado" required>Entregado</option>
		</select>
		<label>FECHA ALTA</label>
		<input type="date" id='fechaalta' required><br>
		<label>LIBROS</label>
		<input type="text" id='libros' required><br>
		<br>
		<label></label>
		<input type="submit" id='alta' value='Alta pedido'>
	</form>
</body>
</html>