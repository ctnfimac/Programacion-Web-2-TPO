var waypts;
mapa = {
 map : false,
 marker : false,

 initMap : function() {
   // Creamos un objeto mapa y especificamos el elemento DOM donde se va a mostrar.
	   mapa.map = new google.maps.Map(document.getElementById('mapa'), {
	     center: {lat: -34.6698856, lng: -58.56260529999997},
	     scrollwheel: false,
	     zoom: 15,
	     zoomControl: true,
	     rotateControl : false,
	     mapTypeControl: true,
	     streetViewControl: false,
	   });

	   // Creamos el marcador
	   mapa.marker = new google.maps.Marker({
	   position: {lat: -34.6698856, lng: -58.56260529999997},
	   draggable: true
	   });

	 // Le asignamos el mapa a los marcadores.
	  mapa.marker.setMap(mapa.map);
	  this.marcarRuta();
  },

  marcarRuta: function(){
  	  //get api uses
       
        var destino = document.getElementById("destino").value;
        console.log(destino);

        var geocoder = new google.maps.Geocoder();

	    if(destino!=''){
	          // Llamamos a la función geodecode pasandole la dirección que hemos introducido en la caja de texto.
	         geocoder.geocode({ 'address': destino}, function(results, status){
	         	 var directionsService = new google.maps.DirectionsService;
       		 	 var directionsDisplay = new google.maps.DirectionsRenderer;
	             if (status == 'OK'){
	              // Mostramos las coordenadas obtenidas en el p con id coordenadas
	                // document.getElementById("coordenadas").innerHTML='Coordenadas:   '+results[0].geometry.location.lat()+', '+results[0].geometry.location.lng();
	             	 waypts = [{ location: { lat: -34.6698856, lng: -58.56260529999997 }, stopover: true }, { location: { lat: results[0].geometry.location.lat(), lng: results[0].geometry.location.lng() }, stopover: true }];

				     //api map
				     var map = new google.maps.Map(document.getElementById('mapa'), {
				            zoom: 10,
				            center: { lat: waypts[0].location.lat, lng: waypts[1].location.lng }
				     });
				     
				     // agrega el mapa
				     directionsDisplay.setMap(map);	

				     directionsService.route({
			            origin: { lat: waypts[0].location.lat, lng: waypts[0].location.lng },//db waypoint start
			            destination: { lat: waypts[1].location.lat, lng: waypts[1].location.lng },//db waypoint end
			            waypoints: waypts,
			            travelMode: google.maps.TravelMode.DRIVING //WALKING,TRANSIT, BICYCLING
			        }, function (response, status) {
			            if (status === google.maps.DirectionsStatus.OK) {
			            	// dibuja el recorrido
			                directionsDisplay.setDirections(response);
			                
			                // para la distancia entre las dos direcciones
			                var dist = directionsDisplay.getDirections();
			                var total = 0;
					        var myroute = dist.routes[0];
					        for (var i = 0; i < myroute.legs.length; i++) {
					          total += myroute.legs[i].distance.value;
					        }
					        total = total / 1000;
					        document.getElementById('distancia').innerHTML =  total + ' km';
					        //console.log('distancia:' , total , ' km');

					        /*
					         * para el tiempo entre los dos puntos
					         */
					        // Obtener la duración para la primer ruta
						    var route = response.routes[0];
						    var duration = 0;

						    // Iteramos todos los legs de la ruta
						    route.legs.forEach(function (leg) {
						     // Sumamos la duracion de cada uno
						     // La duración esta en segundos.
						    duration += leg.duration.value;
						    });

						    duration /= 60;
						    console.log('timepo estimado: ' + duration + ' minutos');
						    document.getElementById('tiempoEnAuto').innerHTML =  duration.toFixed(2) + ' min';
			              
			            } else {
			                window.alert('Ha fallat la comunicació amb el mapa a causa de: ' + status);
			            }
			        });
			     }
	          });
	     }
  }
   
}