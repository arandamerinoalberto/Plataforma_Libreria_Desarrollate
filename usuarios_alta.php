<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta usuarios</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/altausuarios.js'></script>
	<script>
		//activar el listener del botón de alta
		window.onload=function() {
			//document.getElementById('alta').onclick=altausuario

			//listener botón alta usuario
			document.getElementById('formulario').onsubmit=function() {
				//desactivar el comportamiento por defecto
				event.preventDefault()
				
				altausuario()
		}
	}

	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>ALTA USUARIOS</h2>
	<form id='formulario'>
		<label>NIF</label>
		<input type="text" id='nif' required><br>
		<label>NOMBRE</label>
		<input type="text" id='nombre' required><br>
		<label>APELLIDOS</label>
		<input type="text" id='apellidos' required><br>
		<label>DIRECCION</label>
		<input type="text" id='direccion' required><br>
		<label>CP</label>
		<input type="text" id='cp' required><br>
		<label>EMAIL</label>
		<input type="text" id='email' required><br>
		<label>TELEFONO</label>
		<input type="text" id='telefono' required><br><br>
		<label></label>
		<input type="submit" id='alta' value='Alta usuario'>
	</form>
</body>
</html>