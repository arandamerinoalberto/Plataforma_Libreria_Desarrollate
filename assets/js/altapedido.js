//función de alta de pedido

function altapedido() {
	//recuperar los datos del formulario
	var pedido 	  = document.getElementById('pedido').value.trim()
	var nombre 	  = document.getElementById('nombre').value.trim()
	var importe = document.getElementById('importe').value.trim()
	var estado = document.getElementById('estado').value.trim()
	var fechaalta = document.getElementById('fechaalta').value.trim()
	var libros = document.getElementById('libros').value.trim()
	

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/altapedido.php';

	var datos = new FormData()
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
			throw 'error en alta de pedido'
		}
	})
	.then(function(mensaje) {
		//alert(mensaje)
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
	