//función de alta de categorias
function altacategoria() {
	//recuperar los datos del formulario
	var nombre 	  = document.getElementById('nombre').value.trim()
	var descripcion = document.getElementById('descripcion').value.trim()

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/altacategoria.php';

	var datos = new FormData()
	datos.append('nombre', nombre)
	datos.append('descripcion', descripcion)

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
			throw 'error en alta de catagoria'
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