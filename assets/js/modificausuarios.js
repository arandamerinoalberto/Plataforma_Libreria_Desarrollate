//función de modificacion de usuarios
function modificausuario() {
	//recuperar los datos del formulario
	var id 	  = document.getElementById('idusuario').value
	var nif 	  = document.getElementById('nif').value.trim()
	var nombre 	  = document.getElementById('nombre').value.trim()
	var apellidos = document.getElementById('apellidos').value.trim()
	var direccion = document.getElementById('direccion').value.trim()
	var cp 		  = document.getElementById('cp').value.trim()
	var email 	  = document.getElementById('email').value.trim()
	var telefono  = document.getElementById('telefono').value.trim()

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/modificausuario.php';

	var datos = new FormData()
	datos.append('id', id)
	datos.append('nif', nif)
	datos.append('nombre', nombre)
	datos.append('apellidos', apellidos)
	datos.append('direccion', direccion)
	datos.append('cp', cp)
	datos.append('email', email)
	datos.append('telefono', telefono)

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
			throw 'error en modificación de usuario'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
	})
	.catch(function(error) {
		alert(error)
	})
} 