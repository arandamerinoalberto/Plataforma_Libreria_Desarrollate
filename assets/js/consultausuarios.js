function consultaUsuarios() {
	var url = 'servicios/consultausuarios.php'

	var parametros = {
		method: 'post'
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
	.then(function(usuarios) {
		//console.log(usuarios)
		if (usuarios.length==0) {
			alert('no hay usuarios')
		} else {
			//construir las filas
			/*
			<tr><td><input type='radio' name='usuario' value=''></td><td>12345678A</td><td>Profesor</td><td>Maligno</td></tr>
			*/
			var filasTabla = '';

			for (i in usuarios) {
				filasTabla += `<tr>`
				filasTabla += `<td><input type='radio' name='usuario' value='${usuarios[i]['idusuario']}'></td>`
				filasTabla += `<td>${usuarios[i].nif}</td>`
				filasTabla += `<td>${usuarios[i].nombre}</td>`
				filasTabla += `<td>${usuarios[i].apellidos}</td>`
				filasTabla += `</tr>`
			}

			document.getElementById('usuarios').innerHTML += filasTabla
		}

	})
	.catch(function(error) {
		alert(error)
	})
}