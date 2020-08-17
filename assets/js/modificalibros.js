//función de modificación de libros

function modificaLibro() {
	//recuperar los datos del formulario
	var titulo 	  = document.getElementById('titulo').value.trim()
	var precio = document.getElementById('precio').value.trim()
	var stock = document.getElementById('stock').value.trim()
	var idlibro = document.getElementById('idlibro').value
	var categorias = document.querySelectorAll('input[name=categorias]:checked')

	//recuperar el id de las opciones seleccionadas
	var idcategorias = [];

	//1.opción foreach
	categorias.forEach(function(opcion) {
		idcategorias.push(opcion.value)
	})

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/modificalibro.php';

	var datos = new FormData()
	datos.append('idlibro', idlibro)
	datos.append('titulo', titulo)
	datos.append('precio', precio)
	datos.append('stock', stock)
	//convertir el array de categorias a JSON
	datos.append('idcat', JSON.stringify(idcategorias))

	var parametros = {
		method: 'post',
		body: datos
	}

	fetch(url, parametros)
	.then(function(respuesta) {
		if (respuesta.ok) {
			return respuesta.json()
		} else {
			console.log(respuesta)
			throw 'error en modificación de libro'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
		//console.log(mensaje)
	})
	.catch(function(error) {
		alert(error)
	})
} 