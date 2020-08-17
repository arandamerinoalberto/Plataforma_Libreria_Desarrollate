//función de baja de pedidos
function bajapedido() {
	//recuperar los datos del formulario
	var id = document.getElementById('idpedido').value
	
	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/bajapedido.php';

	var datos = new FormData()
	datos.append('id', id)

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
			throw 'error en baja de pedido'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
		window.location.href='pedidos_consulta.php'
	})
	.catch(function(error) {
		alert(error)
	})
} 