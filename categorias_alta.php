<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>alta categorias</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/altacategorias.js'></script>
	<script>
		//activar el listener del botón de alta
		window.onload=function() {
			document.getElementById('alta').onclick=altacategoria
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>ALTA CATEGORIAS</h2>
	<form id='formulario'>
		<label>NOMBRE</label>
		<input type="text" id='nombre'><br>
		<label>DESCRIPCION</label>
		<textarea id='descripcion' cols="20" rows="5"></textarea>
		<br><br>
		<label></label>
		<input type="button" id='alta' value='Alta categoria'>
	</form>
</body>
</html>