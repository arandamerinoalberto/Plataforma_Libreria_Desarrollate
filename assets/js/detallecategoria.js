function detalleCategoria(id) {

	var url = 'servicios/consultacategorias.php'

	var datos = new FormData()
	datos.append('idcategoria', id)

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
	.then(function(categoria) {
		//console.log(categoria)
		//informar el formulario
		if (categoria.length > 0) {
			document.getElementById('nombre').value = categoria[0].nombre
			document.getElementById('descripcion').value = categoria[0].descripcion
			document.getElementById('idcategoria').value = categoria[0].idcategoria
		} else {
			window.location.href='categorias_consulta.html';
		}
	})
	.catch(function(error) {
		alert(error)
	})
}