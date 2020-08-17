//función de modificacion de usuarios
function modificacategoria() {
	//recuperar los datos del formulario
	var id 	  = document.getElementById('idcategoria').value
	var nombre 	  = document.getElementById('nombre').value.trim()
	var descripcion = document.getElementById('descripcion').value.trim()

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/modificacategoria.php';

	var datos = new FormData()
	datos.append('id', id)
	datos.append('nombre', nombre)
	datos.append('descripcion', descripcion)

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
			throw 'error en modificación de categoria'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
	})
	.catch(function(error) {
		alert(error)
	})
} 