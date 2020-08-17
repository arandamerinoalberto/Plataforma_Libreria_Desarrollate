//async se utiliza para indicar que una función es asíncrona
async function consultaCategorias(tiposalida) {
	var url = 'servicios/consultacategorias.php'

	var parametros = {
		method: 'post'
	}

	//con await indicamos que se debe interrumpir la ejecución del código hasta que se complete la función fetch
	await fetch(url, parametros)
	.then(function(respuesta) {
		if (respuesta.ok) {
			return respuesta.json()
		} else {
			console.log(respuesta)
			throw 'error en la petición'
		}
	})
	.then(function(categorias) {
		//console.log(categorias)
		if (categorias.length==0) {
			alert('no hay categorías')
		} else {
			//evaluar el paráemtro de entrada a la función para saber que tipo de salida tenemos crear
			switch (tiposalida) {
				case 'T': 
					//tabla
					confeccionarTabla(categorias);
					break;
				case 'S':
					//select
					confeccionarSelect(categorias);
					break;
				case 'C':
					//checkbox
					confeccionarChecks(categorias);
					break;
				default:
					alert('opción consulta incorrecta')
					return;
			}
		}
	})
	.catch(function(error) {
		alert(error)
	})

	//alert('hola')
}

function confeccionarTabla(categorias) {
	//construir las filas
			
	var cat_html = '';

	for (i in categorias) {
		cat_html += `<tr>`
		cat_html += `<td><input type='radio' name='categoria' value='${categorias[i]['idcategoria']}'></td>`
		cat_html += `<td>${categorias[i].nombre}</td>`
		cat_html += `<td>${categorias[i].descripcion}</td>`
		cat_html += `</tr>`
	}

	document.getElementById('categorias').innerHTML += cat_html	
}

function confeccionarSelect(categorias) {
	//construir las option de la select

	var cat_html=''

	for (i in categorias) {
		cat_html += `<option value='${categorias[i].idcategoria}'>`
		cat_html += categorias[i].nombre
		cat_html += '</option>'
	}

	document.getElementById('categorias').innerHTML += cat_html
}

function confeccionarChecks(categorias) {
	//construir los checkbox

	var cat_html=''

	for (i in categorias) {
		cat_html += `<input type='checkbox' name='categorias' value='${categorias[i].idcategoria}'>`
		cat_html += `<span class='categoriaschecks'>${categorias[i].nombre}</span><br>`
	}

	document.getElementById('categorias').innerHTML = cat_html
}