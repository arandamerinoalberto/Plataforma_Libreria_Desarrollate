<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>mantenimiento usuarios</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/detalleusuarios.js'></script>
	<script src='assets/js/bajausuarios.js'></script>
	<script src='assets/js/modificausuarios.js'></script>
	<script>
		//procesos a ejecutar cuando se carga la página
		window.onload=function() {
			//recuperar la url
			let url = window.location.href

			//posición que ocupa el ?
			let posicion = url.indexOf('?id');

			if (posicion == -1) {
				//acceso a la pantalla sin selección previa de un usuario
				window.location.href='usuarios_consulta.php';
			} else {
				//cortar la url por donde indica la posición + 4 (?id=)

				var idusuario = url.substring(posicion+4)
				
				//llamar a la función de consulta
				detalleUsuario(idusuario)

				//listener boton de modificacion
				document.getElementById('modi').onclick=modificausuario

				//listener boton de baja
				document.getElementById('baja').onclick=bajausuario
			}
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>MODIFICACIÓN/BAJA USUARIOS</h2>
	<form>
		<label>NIF</label>
		<input type="text" id='nif'><br>
		<label>NOMBRE</label>
		<input type="text" id='nombre'><br>
		<label>APELLIDOS</label>
		<input type="text" id='apellidos'><br>
		<label>DIRECCION</label>
		<input type="text" id='direccion'><br>
		<label>CP</label>
		<input type="text" id='cp'><br>
		<label>EMAIL</label>
		<input type="text" id='email'><br>
		<label>TELEFONO</label>
		<input type="text" id='telefono'><br><br>
		<label><input type="button" id='consulta' value='Volver' onclick="javascript:window.location.href='usuarios_consulta.php'"></label>
		
		<input type="button" id='baja' value='Baja usuario'>
		<input type="button" id='modi' value='Modificación'>
		<!--guardar el id del usuario en un campo oculto-->
		<input type="hidden" id='idusuario'>
	</form>
</body>
</html>