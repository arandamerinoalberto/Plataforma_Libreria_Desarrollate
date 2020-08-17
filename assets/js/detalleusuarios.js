function detalleUsuario(id) {

	var url = 'servicios/consultausuarios.php'

	var datos = new FormData()
	datos.append('idusuario', id)

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
			throw 'error en la petición'
		}
	})
	.then(function(usuario) {
		//console.log(usuario)
		//informar el formulario
		if (usuario.length > 0) {
			document.getElementById('nif').value = usuario[0].nif
			document.getElementById('nombre').value = usuario[0].nombre
			document.getElementById('apellidos').value = usuario[0].apellidos
			document.getElementById('direccion').value = usuario[0].direccion
			document.getElementById('cp').value = usuario[0].cp
			document.getElementById('email').value = usuario[0].email
			document.getElementById('telefono').value = usuario[0].telefono
			document.getElementById('idusuario').value = usuario[0].idusuario
		} else {
			window.location.href='usuarios_consulta.php';
		}
	})
	.catch(function(error) {
		alert(error)
	})
}