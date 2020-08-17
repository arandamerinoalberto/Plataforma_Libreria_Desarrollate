//función de alta de libros

function altaLibro() {
	//recuperar los datos del formulario
	var titulo 	  = document.getElementById('titulo').value.trim()
	var precio = document.getElementById('precio').value.trim()
	var stock = document.getElementById('stock').value.trim()
	var categorias = document.querySelectorAll('#categorias option:checked:not([disabled])')

	//var categorias = document.querySelectorAll('input[name=categorias]:checked')

	//recuperar el id de las opciones seleccionadas
	var idcategorias = [];

	//1.opción foreach
	categorias.forEach(function(opcion) {
		idcategorias.push(opcion.value)
	})

	/*
	//2.opción bucle for tradicional
	for (i=0; i<categorias.length;i++) {
		idcategorias.push(categorias[i].value)
	} 
	*/

	//console.log(idcategorias)

	//opcionalmente validar los datos

	//realizar la petición ajax
	var url = 'servicios/altalibro.php';

	var datos = new FormData()
	datos.append('titulo', titulo)
	datos.append('precio', precio)
	datos.append('stock', stock)
	//convertir el array de categorias a JSON
	datos.append('idcat', JSON.stringify(idcategorias))

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
			throw 'error en alta de libro'
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