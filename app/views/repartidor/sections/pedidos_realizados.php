<?php

$pedidoModel = new PedidoModel();
$comercioModel = new ComercioModel();
$clienteModel = new ClienteModel();
$repartidorModel = new RepartidorModel();

$pedidos = $pedidoModel->mostrarPedidos();

$info = '';
$id_pedido = '';
$cont_id = 1;

//$pedidoModel->actualizarPenalizaciones();

$estado_del_delivery_de_la_cuenta = $repartidorModel->estadoDelRepartidorDeLaCuenta();

foreach($pedidos as $pedido){
	$comercio = $comercioModel->obtenerNombreDelComercio($pedido->getComercio());
	$cliente = $clienteModel->obtenerNombreDelCliente($pedido->getCliente());
	$repartidor =  $repartidorModel->obtenerNombreDelRepartidor($pedido->getRepartidor()) == false ? 'sin asignar' : $repartidorModel->obtenerNombreDelRepartidor($pedido->getRepartidor()) ;
	$id_pedido = $pedido->getId();

	$button = '';
	//$estado_clase = '';
	if($pedido->getEstadoDelPedido() == 1 && $estado_del_delivery_de_la_cuenta == false)
		$button = '<a href="index.php?route=repartidor&operacion=tomar_pedido&id_pedido='.$pedido->getId().'&cliente='.$pedido->getCliente().'" class="btn text-white btn-success mr-2">Tomar Pedido</a>';
		
	if($pedido->getEstadoDelPedido() == 2 && $repartidor == $_SESSION['admin'])	
		$button = '<a href="index.php?route=repartidor&operacion=cancelar_pedido&id_pedido='.$pedido->getId().'" class="btn text-white btn-danger mr-2">Cancelar</a>
				   <a href="index.php?route=repartidor&operacion=finalizar_pedido&id_pedido='.$pedido->getId().'" class="btn text-white btn-warning ml-2">Finalizar</a>';

	$info .= '<tr>
		<td>'.$comercio.'</td>
		<td>'.$cliente.'</td>
		<td>'.$pedido->getFecha().'</td>
		<td>'.$pedido->getHora().'</td>
		<td>'.$repartidor.'</td>
		<td>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-'.$cont_id.'">
				Ver Detalles
			</button> 
		</td>
		<td>'.$pedido->getEstadoDelPedidoStr().'</td>
		<td>$'.$pedido->getPrecioTotal().'</td>
		<td>$'.$pedido->getPenalizado().'</td>
		<td class="align-middle">
			<div class="btn-group" role="group">
				'.$button.'
			</div>
		</td>
	</tr>';
	asignarMenus($cont_id, $id_pedido,$pedidoModel);
	$cont_id++;
	// $hora = date("H:i:s",time());
	// echo 'hola actual: ' . $hora . '<br>';
	// $diferencia = $hora - $pedido->getHora();
	// echo 'diferencia: ' . $diferencia;
}
/*
function calcular_tiempo_trasnc($hora1,$hora2){
	//echo $hora1 . ' - ' . $hora2 .'<br>' ;
    $separar[1]=explode(':',$hora1);
    $separar[2]=explode(':',$hora2);

	$total_minutos_trasncurridos[1] = ($separar[1][0] * 60) + $separar[1][1];
	$total_minutos_trasncurridos[2] = ($separar[2][0] * 60) + $separar[2][1];
	$total_minutos_trasncurridos = $total_minutos_trasncurridos[1]  - $total_minutos_trasncurridos[2];
	if($total_minutos_trasncurridos<=59) return $total_minutos_trasncurridos;//minutos
	// elseif($total_minutos_trasncurridos>59){
	// 	$HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60);
	// 	if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA;
	// 	$MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60;
	// 	if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS;
	// 	return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.' Horas');
	// } 
}
//llamamos la función e imprimimos
$fecha = date("Y-m-d H:i:s",time());
$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
date_default_timezone_set('America/Argentina/Buenos_Aires');
//echo calcular_tiempo_trasnc('16:50',date("H:i",time()));
*/
$tablaPedidos = '
<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
		<i class="fas fa-table"></i>
		Pedidos
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered text-center table-dark" id="dataTable" width="100%%" cellspacing="0">
			<thead>
				<tr>
				<th>comercio</th>
				<th>cliente</th>
				<th>fecha</th>
				<th>hora</th>
				<th>repartidor asignado</th>
				<th>detalles</th>
				<th>Estado</th>
				<th>precio</th>
				<th>penalizado</th>
				<th>operacion</th>
				</tr>
			</thead>
			<tbody>
			    '.$info.'			
			</tbody>
			</table>
		</div>
		</div>
	</div>

	</div>
	<!-- /.container-fluid -->
';


function asignarMenus($cont_id, $id_pedido , $pedidoModel){
	$tabla_menus = $pedidoModel->getMenuDePedido($id_pedido);
	$menus= '';

	foreach($tabla_menus as $menu){
		$menus .= '<tr>
			<td>'.$menu->getDescripcion().'</td>
			<td class="align-middle justify-content-center"><img src="'.$menu->getImagen().'" width=125></td>
			<td>$'.$menu->getPrecio().'</td>
			<td>'.$menu->getCantidad().'</td>
			</tr>';
		}

		$tablaMenus = '
			<div class="card mb-3">
				<div class="card-header">
				<i class="fas fa-table"></i>
				Mis Pedidos
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered text-center table-dark" id="dataTable" width="100%%" cellspacing="0">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>imagen</th>
								<th>precio</th>
								<th>cantidad</th>
							</tr>
						</thead>
						<tbody>
							'.$menus.'			
						</tbody>
						</table>
					</div>
				</div>
			</div>
		';

		echo '
		<!-- Modal -->
		<div class="modal fade" id="exampleModal-'.$cont_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				'.$tablaMenus.'
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
			</div>
		</div>
		</div>';
}

