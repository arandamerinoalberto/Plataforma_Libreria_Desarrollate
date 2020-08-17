//función de baja de categoria
function bajacategoria() {
	//recuperar los datos del formulario
	var id 	  = document.getElementById('idcategoria').value
	
	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/bajacategoria.php';

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
			throw 'error en baja de categoria'
		}
	})
	.then(function(mensaje) {
		alert(mensaje[1])
		if (mensaje[0]=='00') {
			window.location.href='categorias_consulta.php'
		}
	})
	.catch(function(error) {
		alert(error)
	})
} 