<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>consulta usuarios</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/consultausuarios.js'></script>
	<script>
		//cargar todos los usuarios cuando se cargue la página
		window.onload=function() {
			consultaUsuarios()

			//activar el botón consultar
			document.getElementById('consultar').onclick=enlaceMantenimiento
		}

		function enlaceMantenimiento() {
			//recuperar el checkbox que esté seleccionado
			var idusuario = document.querySelector('[name=usuario]:checked').value

			//alert(idusuario)

			//enlazar con la pantalla de mantenimiento pasando por la url el id del usuario
			window.location.href = `usuarios_mantenimiento.php?id=${idusuario}`;
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>CONSULTA USUARIOS</h2>
	<table id='usuarios'>
		<tr><th></th><th>NIF</th><th>NOMBRE</th><th>APELLIDOS</th></tr>
		<!--tr><td><input type='radio' name='usuario' value=''></td><td>12345678A</td><td>Profesor</td><td>Maligno</td></tr-->
	</table><br><br>
	<center><input type="button" id='consultar' value='Consulta detalle'></center>
</body>
</html>