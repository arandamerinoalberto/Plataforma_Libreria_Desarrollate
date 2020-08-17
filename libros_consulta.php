<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>consulta libros</title>
	<link rel="stylesheet" href="assets/css/estilos.css">
	<script src='assets/js/consultalibros.js'></script>
	<!-- <script src='assets/js/buscarlibros.js'></script> -->
	<script>
		window.onload=function() {
			//cargar todos los libros cuando se cargue la página
			consultaLibros()

			//activar el botón consultar
			document.getElementById('consultar').onclick=enlaceMantenimiento

			//activar el formulario de busqueda
			//document.getElementById('palabro').removeAttribute('disabled')
			//document.getElementById('buscar').removeAttribute('disabled')

			//document.getElementById('buscar').onclick=function() {
					//buscaLibros()
				//}
		}

		function enlaceMantenimiento() {
			//recuperar el checkbox que esté seleccionado
			var idlibro = document.querySelector('input[name=libro]:checked').value

			//alert(idlibro)

			//enlazar con la pantalla de mantenimiento pasando el id del libro (por url o utilizando el sessionStorage)
			sessionStorage.setItem('libreria_idlibro', idlibro)

			window.location.href='libros_mantenimiento.php'
		}
	</script>
</head>
<body>
	<nav><?php include 'include/nav.html' ?></nav>
	<h2>CONSULTA LIBROS</h2>
	<table id='libros'>
		<tr><th></th><th>TITULO</th><th>PRECIO</th></tr>
		<!--tr><td><input type='radio' name='libro' value=''></td><td>Testaferría avanzada</td><td>99,99</td></tr-->
	</table><br>
	<center><span id='enlaces'></span></center>
	<br>
	<center><input type="button" id='consultar' value='Consulta detalle'></center>
</body>
</html>