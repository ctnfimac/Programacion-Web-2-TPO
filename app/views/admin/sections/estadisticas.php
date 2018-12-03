<?php

$pedidos = new PedidoModel();
$registro = $pedidos->cantidadDePedidosPorComercio();
$pedidos->ventasTotalesPorMes();
$meses = ['enero','febrero' ,'marzo ', 'abril', 'mayo', 'junio', 
					  'julio', 'agosto', 'septiembre', 'octubre', 'noviembre','diciembre'] ;

?>
	<h2 class="text-center">Estadísticas</h2>

    <script type="text/javascript" src="./public/js/loader.js "></script>
    <script type="text/javascript">
      // Load Charts and the corechart package.
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(ventasTotalesPorMes);
	  google.charts.setOnLoadCallback(gananciasTotalesPorMes);
	  google.charts.setOnLoadCallback(cantidadDePedidosPorComercio);
	  google.charts.setOnLoadCallback(gananciaTotalPorComercioEnElMes);
	  google.charts.setOnLoadCallback(cantidadDePedidosPorCliente);
	  google.charts.setOnLoadCallback(cantidadDePedidosTotalesPorCliente);
	  google.charts.setOnLoadCallback(cantidadDePedidosRealizadosPorRepartidor);
	  google.charts.setOnLoadCallback(topRankingRepartidores);
	  google.charts.setOnLoadCallback(topRankingComercios);
      function ventasTotalesPorMes() {
        // Create the data table for Sarah's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
			<?php 	      
			$registro = $pedidos->ventasTotalesPorMes();
				while($row = $registro->fetch_assoc()){
					//echo "['hola',2],";
					$mes = $meses[$row['mes'] -1 ];
					$cantidad = $row['cantidad'] ;
					echo "[ '$mes', $cantidad],";
				}
			
			?>
        ]);

        // Set options for Sarah's pie chart.
        var options = {title:'Ventas realizadas por mes',
                       width:400,
                       height:300};

        // Instantiate and draw the chart for Sarah's pizza.
        var chart = new google.visualization.ColumnChart(document.getElementById('Sarah_chart_div'));
        chart.draw(data, options);
      }

      // Callback that draws the pie chart for Anthony's pizza.
      function gananciasTotalesPorMes() {

        // Create the data table for Anthony's pizza.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
			<?php 	      
			$registro = $pedidos->gananciasTotalesPorMes();
				while($row = $registro->fetch_assoc()){
					$mes = $meses[$row['mes'] -1 ];
					$cantidad = $row['monto_total'] ;
					echo "[ '$mes', $cantidad],";
				}
			
			?>
        ]);

        // Set options for Anthony's pie chart.
        var options = {title:'Ganancias totales por mes',
                       width:400,
                       height:300};

        // Instantiate and draw the chart for Anthony's pizza.
        var chart = new google.visualization.ColumnChart(document.getElementById('Anthony_chart_div'));
        chart.draw(data, options);
	  }
	  
	   // Callback that draws the pie chart for Anthony's pizza.
	   function cantidadDePedidosPorComercio() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Topping');
		data.addColumn('number', 'Slices');
		data.addRows([
			<?php 	      
			$registro = $pedidos->cantidadDePedidosPorComercio();
				while($row = $registro->fetch_assoc()){
					$comercio = $row['comercio'];
					$cantidad = $row['cantidad'] ;
					echo "[ '$comercio', $cantidad],";
				}
			
			?>
		]);
		var options = {title:'Ventas mensuales totales por Comercio',
					width:400,
					height:300};

		// Instantiate and draw the chart for Anthony's pizza.
		var chart = new google.visualization.ColumnChart(document.getElementById('ventasTotalesPorComercioEnElMes'));
		chart.draw(data, options);
		}


		function gananciaTotalPorComercioEnElMes() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 	      
				$registro = $pedidos->gananciaTotalPorComercioEnElMes();
					while($row = $registro->fetch_assoc()){
						$comercio = $row['comercio'];
						$cantidad = $row['monto_total'] ;
						echo "[ '$comercio', $cantidad],";
					}
				
				?>
			]);
			var options = {title:'Ganancias del mes actual por comercio',
						width:400,
						height:300
						};

			// Instantiate and draw the chart for Anthony's pizza.
			var chart = new google.visualization.ColumnChart(document.getElementById('gananciaTotalPorComercioEnElMes'));
			chart.draw(data, options);
		}

		function cantidadDePedidosPorCliente() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 	      
				$registro = $pedidos->cantidadDePedidosPorCliente();
					while($row = $registro->fetch_assoc()){
						$comercio = $row['cliente'];
						$cantidad = $row['cantidad'] ;
						echo "[ '$comercio', $cantidad],";
					}
				
				?>
			]);
			var options = {title:'Cantidad de pedidos mensual por cliente',
						width:400,
						height:300
						};

			// Instantiate and draw the chart for Anthony's pizza.
			var chart = new google.visualization.ColumnChart(document.getElementById('cantidadDePedidosPorCliente'));
			chart.draw(data, options);
		}

		function cantidadDePedidosTotalesPorCliente() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 	      
				$registro = $pedidos->cantidadDePedidosTotalesPorCliente();
					while($row = $registro->fetch_assoc()){
						$comercio = $row['cliente'];
						$cantidad = $row['cantidad'] ;
						echo "[ '$comercio', $cantidad],";
					}
				
				?>
			]);
			var options = {title:'Cantidad de pedidos totales por cliente',
						width:400,
						height:300
						};

			// Instantiate and draw the chart for Anthony's pizza.
			var chart = new google.visualization.ColumnChart(document.getElementById('cantidadDePedidosTotalesPorCliente'));
			chart.draw(data, options);
		}

		function cantidadDePedidosRealizadosPorRepartidor() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 	      
				$registro = $pedidos->cantidadDePedidosRealizadosPorRepartidor();
					while($row = $registro->fetch_assoc()){
						$repartidor = $row['repartidor'];
						$cantidad = $row['cantidad'] ;
						echo "[ '$repartidor', $cantidad],";
					}
				
				?>
			]);
			var options = {title:'Cantidad de pedidos totales Realizados por repartidor en el mes',
						width:400,
						height:300
						};

			// Instantiate and draw the chart for Anthony's pizza.
			var chart = new google.visualization.ColumnChart(document.getElementById('cantidadDePedidosRealizadosPorRepartidor'));
			chart.draw(data, options);
		}

		function topRankingRepartidores() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 	      
				$registro = $pedidos->topRankingRepartidores();
					while($row = $registro->fetch_assoc()){
						$repartidor = $row['repartidor'];
						$cantidad = $row['cantidad'] ;
						echo "[ '$repartidor', $cantidad],";
					}
				
				?>
			]);
			var options = {title:'Top ranking de los 5 repartidores con más ventas',
						width:400,
						height:300
						};

			// Instantiate and draw the chart for Anthony's pizza.
			var chart = new google.visualization.PieChart(document.getElementById('topRankingRepartidores'));
			chart.draw(data, options);
		}

		function topRankingComercios() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Topping');
			data.addColumn('number', 'Slices');
			data.addRows([
				<?php 	      
				$registro = $pedidos->topRankingComercios();
					while($row = $registro->fetch_assoc()){
						$repartidor = $row['comercio'];
						$cantidad = $row['cantidad'] ;
						echo "[ '$repartidor', $cantidad],";
					}
				
				?>
			]);
			var options = {title:'Top ranking de los 5 Comercios con más ventas',
						width:400,
						height:300
						};

			// Instantiate and draw the chart for Anthony's pizza.
			var chart = new google.visualization.PieChart(document.getElementById('topRankingComercios'));
			chart.draw(data, options);
		}
    </script>


    <!--Table and divs that hold the pie charts-->
	<div class="container">
	  <div class="row justify-content-center">
	  	<div id="Sarah_chart_div" style="border: 1px solid #ccc"></div>
        <div id="Anthony_chart_div" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="ventasTotalesPorComercioEnElMes" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="gananciaTotalPorComercioEnElMes" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="cantidadDePedidosPorCliente" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="cantidadDePedidosTotalesPorCliente" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="cantidadDePedidosRealizadosPorRepartidor" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="topRankingRepartidores" class="m-1" style="border: 1px solid #ccc"></div>
		<div id="topRankingComercios" class="m-1" style="border: 1px solid #ccc"></div>
	  </div>
	</div>
  
 

