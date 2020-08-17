//función de baja de libros

function bajaLibro() {
	//recuperar los datos del formulario
	var idlibro = document.getElementById('idlibro').value
	
	//realizar la petición ajax
	var url = 'servicios/bajalibro.php';

	var datos = new FormData()
	datos.append('idlibro', idlibro)

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
			throw 'error en baja de libro'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
		if (mensaje[0] == '00') {
			//dirigir a la pantalla de consulta
			window.location.href = 'libros_consulta.php'
		}
	})
	.catch(function(error) {
		alert(error)
	})
} 