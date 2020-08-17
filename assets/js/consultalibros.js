function consultaLibros(pag=1) {
	//alert(pag)

	var url = 'servicios/consultalibros.php'

	//enviar la página a consultar al servidor
	var datos = new FormData();
	datos.append('pag', pag)

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
	.then(function(libros) {
		console.log(libros)
		//separar los libros del numero de páginas
		var listaLibros = libros[0]
		var paginas = libros[1] 

		if (listaLibros.length==0) {
			alert('no hay libros')
		} else {
			//construir las filas
			var html = '<tr><th></th><th>TITULO</th><th>PRECIO</th></tr>';

			for (i in listaLibros) {
				html += `<tr>`
				html += `<td><input type='radio' name='libro' value='${listaLibros[i]['idlibro']}'></td>`
				html += `<td>${listaLibros[i].titulo}</td>`
				html += `<td>${listaLibros[i].precio} €</td>`
				html += `</tr>`
			}

			document.getElementById('libros').innerHTML = html	

			//construir los enlaces paginación
			var enlaces=''

			for (e = 1; e <= paginas; e++) {
				if (e == pag) {
					enlaces += `<input type='button' value='${e} ' onclick='consultaLibros(${e})' class='seleccionado'>`
				} else {
					enlaces += `<input type='button' value='${e} ' onclick='consultaLibros(${e})'>`
				}	
			}

			document.getElementById('enlaces').innerHTML = enlaces
		}
	})
	.catch(function(error) {
		alert(error)
	})
}