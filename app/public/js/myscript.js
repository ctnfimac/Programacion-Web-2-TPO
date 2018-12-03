var c_dni = document.getElementById("c-dni");
var c_cuit = document.getElementById("c-cuit");
var c_localidad = document.getElementById("c-localidad");
var c_direccion = document.getElementById("c-direccion");
var c_apellido = document.getElementById("c-apellido");

var cliente = document.getElementById("tipoDeCliente");

(function(){
	c_dni.style.display = "none";
	c_dni.style.visibility = "hidden";

	c_cuit.style.display = "none";
	c_cuit.style.visibility = "hidden";
	
})();

function selectFunction(){
	console.log(cliente.value);
	switch(cliente.value){
		case '1':
			formCliente();
			break;
		case '2':
			formRepartidor();
			break;
		case '3':
			formComercio()
			break;
		default:
			break;
	}
}

function formCliente(){
	c_apellido.style.display = "block";
	c_apellido.style.visibility = "visible";
	
	c_dni.style.display = "none";
	c_dni.style.visibility = "hidden";

	c_cuit.style.display = "none";
	c_cuit.style.visibility = "hidden";

	c_localidad.style.display = "block";
	c_localidad.style.visibility = "visible";

	c_direccion.style.display = "block";
	c_direccion.classList.add = "form-row";
	c_direccion.style.visibility = "visible";
}

function formRepartidor(){
	c_apellido.style.display = "block";
	c_apellido.style.visibility = "visible";

	c_dni.style.display = "block";
	c_dni.style.visibility = "visible";

	c_cuit.style.display = "none";
	c_cuit.style.visibility = "hidden";

	c_localidad.style.display = "none";
	c_localidad.style.visibility = "hidden";

	c_direccion.style.display = "none";
	c_direccion.style.visibility = "hidden";
}

function formComercio(){
	c_apellido.style.display = "none";
	c_apellido.style.visibility = "hidden";

	c_dni.style.display = "none";
	c_dni.style.visibility = "hidden";

	c_cuit.style.display = "block";
	c_cuit.style.visibility = "visible";

	c_localidad.style.display = "none";
	c_localidad.style.visibility = "hidden";

	c_direccion.style.display = "none";
	c_direccion.style.visibility = "hidden";
}