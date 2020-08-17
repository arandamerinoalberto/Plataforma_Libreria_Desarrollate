function detalleLibro(id) {

	var url = 'servicios/consultalibro.php'

	var datos = new FormData()
	datos.append('idlibro', id)

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
	.then(function(libro) {
		console.log(libro)
		//informar el formulario
		if (libro.length > 0) {
			document.getElementById('titulo').value = libro[0].titulo
			document.getElementById('precio').value = libro[0].precio
			document.getElementById('stock').value = libro[0].stock
			document.getElementById('idlibro').value = libro[0].idlibro

			var categoriasLibro = libro[1];
			//  [3, 11]

			for (c in categoriasLibro) {
				document.querySelector(`#categorias input[value='${categoriasLibro[c]}']`).setAttribute('checked', 'true')

				//document.querySelector(`#categorias input[value='3'`).setAttribute('checked', 'true')
			}

		} else {
			window.location.href='libros_consulta.html';
		}
	})
	.catch(function(error) {
		alert(error)
	})
}