function detallePedido(id) {

	var url = 'servicios/consultapedidos.php'

	var datos = new FormData()
	datos.append('idpedido', id)

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
	.then(function(pedido) {
		console.log(pedido)
		//informar el formulario
		if (pedido.length > 0) {
			document.getElementById('idpedido').value = pedido[0].idpedido
			document.getElementById('pedido').value = pedido[0].pedido
			document.getElementById('nombre').value = pedido[0].nombre
			document.getElementById('importe').value = pedido[0].importe
			document.getElementById('estado').value = pedido[0].estado
			document.getElementById('fechaalta').value = pedido[0].fechaalta
			document.getElementById('libros').value = pedido[0].libros
		} else {
			window.location.href='pedidos_consulta.php';
		}
	})
	.catch(function(error) {
		alert(error)
	})
}