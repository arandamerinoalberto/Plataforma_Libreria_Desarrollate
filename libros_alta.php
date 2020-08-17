<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>alta libros</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/consultacategorias.js'></script>
	<script src='assets/js/altalibros.js'></script>
	<script>
		window.onload=function() {
			//cargar las categorías disponibles cuando se carga la página
			consultaCategorias('S')

			//listener botón alta libro
			document.getElementById('formulario').onsubmit=function() {
					//desactivar el comportamiento por defecto
					event.preventDefault()

					altaLibro()
				}
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>ALTA LIBROS</h2>
	<form id='formulario'>
		<label>TITULO</label>
		<input type="text" id='titulo' required><br>
		<label>PRECIO</label>
		<input type="number" id='precio' step='0.01' required><br>
		<label>STOCK</label>
		<input type="number" id='stock' required><br>
		<label>CATEGORIAS</label>
		<select id="categorias" multiple required>
			<option value="0" disabled selected>Seleccione categorías</option>
		</select><br><br>
		<label></label>
		<input type="submit" id='alta' value='Alta libro'>
	</form>
</body>
</html>