function consultaPedidos() {
	var url = 'servicios/consultapedidos.php'

	var parametros = {
		method: 'post'
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
	.then(function(pedidos) {
		//alert(respuesta)
		//console.log(pedidos)
		if (pedidos.length==0) {
			alert('no hay pedidos')
		} else {
			//construir las filas
			/*
			<tr><td><input type='radio' name='pedido' value=''></td><td>12345678A</td><td>Profesor</td><td>Maligno</td></tr>
			*/
			var filasTabla = '';

			for (i in pedidos) {
				filasTabla += `<tr>`
				filasTabla += `<td><input type='radio' name='pedido' value='${pedidos[i]['idpedido']}'></td>`
				filasTabla += `<td>${pedidos[i].pedido}</td>`
				filasTabla += `<td>${pedidos[i].nombre}</td>`
				filasTabla += `<td>${pedidos[i].importe} €</td>`
				filasTabla += `<td>${pedidos[i].estado}</td>`
				filasTabla += `<td>${pedidos[i].libros}</td>`
				filasTabla += `</tr>`
			}

			document.getElementById('pedidos').innerHTML += filasTabla
		}

	})
	.catch(function(error) {
		alert(error)
	})
}