<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>mantenimiento libros</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/detallelibro.js'></script>
	<script src='assets/js/consultacategorias.js'></script>
	<script src='assets/js/bajalibros.js'></script>
	<script src='assets/js/modificalibros.js'></script>
	<script>
		//procesos a ejecutar cuando se carga la página
		window.onload=function() {
			//recuperar id del libro si existe
			if (sessionStorage.getItem('libreria_idlibro') == undefined) {
				window.location.href='libros_consulta.php'
			} else {
				var idlibro = sessionStorage.getItem('libreria_idlibro')
				
				//consulta de todas las categorías
				consultaCategorias('C')
				.then(function() {
					//llamar a la función de consulta de detalle libro cuando finalice la ejecución de consulta categorias
					detalleLibro(idlibro)
				})
				
				//borrar el storage
				//sessionStorage.removeItem('libreria_idlibro')

				//listener boton de modificacion
				document.getElementById('modi').onclick=modificaLibro

				//listener boton de baja
				document.getElementById('baja').onclick=bajaLibro
			}
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>MODIFICACIÓN/BAJA LIBROS</h2>
	<form id='formulario'>
		<label>TITULO</label>
		<input type="text" id='titulo' required style='width:250px;'><br>
		<label>PRECIO</label>
		<input type="number" id='precio' step='0.01' required><br>
		<label>STOCK</label>
		<input type="number" id='stock' required><br><br>
		<label>CATEGORIAS:</label><br><br>
		<span id="categorias">
		</span>
		<br><br>
		<label><input type="button" id='consulta' value='Volver' onclick="javascript:window.location.href='libros_consulta.php'"></label>
		
		<input type="button" id='baja' value='Baja libro'>
		<input type="button" id='modi' value='Modificación'>
		<!--guardar el id del libro en un campo oculto-->
		<input type="hidden" id='idlibro'>
	</form>
</body>
</html>