<?php

$pedidoModel = new PedidoModel();
$comercioModel = new ComercioModel();
$clienteModel = new ClienteModel();
$repartidorModel = new RepartidorModel();

$pedidos = $pedidoModel->mostrarPedidos();

$info = '';
$id_pedido = '';
$cont_id = 1;

$estado_del_delivery_de_la_cuenta = $repartidorModel->estadoDelRepartidorDeLaCuenta();

foreach($pedidos as $pedido){
	$comercio = $comercioModel->obtenerNombreDelComercio($pedido->getComercio());
	$cliente = $clienteModel->obtenerNombreDelCliente($pedido->getCliente());
	$repartidor =  $repartidorModel->obtenerNombreDelRepartidor($pedido->getRepartidor()) == false ? 'sin asignar' : $repartidorModel->obtenerNombreDelRepartidor($pedido->getRepartidor()) ;
	$id_pedido = $pedido->getId();

	$button = '';
	$estado_clase = '';
	if($pedido->getEstadoDelPedido() == 1 && $estado_del_delivery_de_la_cuenta == false)
		$button = '<a href="index.php?route=repartidor&operacion=tomar_pedido&id_pedido='.$pedido->getId().'&cliente='.$pedido->getCliente().'" class="btn text-white btn-success mr-2 '.$estado_clase.'">Tomar Pedido</a>';
		
	if($pedido->getEstadoDelPedido() == 2 && $repartidor == $_SESSION['admin'])	
		$button = '<a href="index.php?route=repartidor&operacion=cancelar_pedido&id_pedido='.$pedido->getId().'" class="btn text-white btn-danger mr-2">Cancelar</a>
				   <a href="index.php?route=repartidor&operacion=finalizar_pedido&id_pedido='.$pedido->getId().'" class="btn text-white btn-warning ml-2">Finalizar</a>';

	$info .= '<tr>
		<td>'.$pedido->getId().'</td>
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
		<td class="align-middle">
			<div class="btn-group" role="group">
				'.$button.'
			</div>
		</td>
	</tr>';
	asignarMenus($cont_id, $id_pedido,$pedidoModel);
	$cont_id++;
}


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
				<th>id</th>
				<th>comercio</th>
				<th>cliente</th>
				<th>fecha</th>
				<th>hora</th>
				<th>repartidor asignado</th>
				<th>detalles</th>
				<th>Estado</th>
				<th>precio</th>
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

