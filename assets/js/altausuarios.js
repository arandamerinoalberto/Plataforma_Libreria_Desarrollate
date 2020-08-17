
//función de alta de usuarios
function altausuario() {
	//recuperar los datos del formulario
	var nif 	  = document.getElementById('nif').value.trim()
	var nombre 	  = document.getElementById('nombre').value.trim()
	var apellidos = document.getElementById('apellidos').value.trim()
	var direccion = document.getElementById('direccion').value.trim()
	var cp 		  = document.getElementById('cp').value.trim()
	var email 	  = document.getElementById('email').value.trim()
	var telefono  = document.getElementById('telefono').value.trim()

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/altausuario.php';

	var datos = new FormData()
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
			throw 'error en alta de usuario'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
		//console.log(mensaje)
		if (mensaje[0]=='00') {
			//limpiar el formulario
			document.getElementById('formulario').reset()
		} 
	})
	.catch(function(error) {
		alert(error)
	})
} 