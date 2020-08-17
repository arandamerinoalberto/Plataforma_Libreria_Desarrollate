//función de modificacion de pedidos
function modificapedido() {
	//recuperar los datos del formulario
	var id = document.getElementById('idpedido').value.trim()
	var pedido = document.getElementById('pedido').value.trim()
	var nombre = document.getElementById('nombre').value.trim()
	var importe = document.getElementById('importe').value.trim()
	var estado = document.getElementById('estado').value.trim()
	var fechaalta = document.getElementById('fechaalta').value.trim()
	var libros = document.getElementById('libros').value.trim()
	

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/modificapedido.php';

	var datos = new FormData()
	datos.append('id', id)
	datos.append('pedido', pedido)
	datos.append('nombre', nombre)
	datos.append('importe', importe)
	datos.append('estado', estado)
	datos.append('fechaalta', fechaalta)
	datos.append('libros', libros)


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
			throw 'error en modificación de pedido'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
	})
	.catch(function(error) {
		alert(error)
	})
} 