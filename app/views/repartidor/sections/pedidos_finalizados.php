<?php

$pedidoModel = new PedidoModel();
$pedidos = $pedidoModel->mostrarMisPedidosFinalizados();

$info = '';
$id_pedido = '';
$cont_id = 1;
foreach($pedidos as $pedido){
	$id_pedido = $pedido->getId();
	$repartidor = $pedido->getRepartidor() == null ? 'sin asignar': $pedido->getRepartidor();
	$info .= '<tr>
		<td class="align-middle">'.$pedido->getId().'</td>
		<td class="align-middle">'.$pedido->getComercio().'</td>
		<td class="align-middle">'.$pedido->getCliente().'</td>
		<td class="align-middle">'.$pedido->getFecha().'</td>
		<td class="align-middle">'.$pedido->getHora().'</td>
		<td class="align-middle">'.$repartidor.'</td>
		<td>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-'.$cont_id.'">
				Ver Detalles
			</button> 
		</td>
		<td class="align-middle">'.$pedido->getEstadoDelPedidoStr().'</td>
		<td class="align-middle">$ '.$pedido->getPenalizado().'</td>
		<td class="align-middle">$ '.$pedido->getPrecioTotal().'</td>
		
		<!--<td class="align-middle">
		<div class="btn-group" role="group">
			<a href="#" class="btn text-white btn-primary disabled">Modificar</a>
			<a href="#" class="btn text-white btn-danger disabled">Eliminar</a>
		</div></td>-->
	</tr>';
	asignarMenus($cont_id, $id_pedido,$pedidoModel);
	$cont_id++;
}


$tablaPedidosFinalizados = '
<!-- DataTables Example -->
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
				<th>id</th>
				<th>comercio</th>
				<th>cliente</th>
				<th>fecha</th>
				<th>hora</th>
				<th>repartidor asignado</th>
				<th>detalles</th>
				<th>Estado</th>
				<th>penalizado</th>
				<th>precio</th>
				</tr>
			</thead>
			<tbody>
			    '.$info.'			
			</tbody>
			</table>
		</div>
		</div>
		<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
	</div>

	</div>
	<!-- /.container-fluid -->
';


function asignarMenus($cont_id, $id_pedido , $pedidoModel){
	$tabla_menus = $pedidoModel->getMenuDePedido($id_pedido);
	$menus= '';

	foreach($tabla_menus as $menu){
		$menus .= '<tr>
			<td class="align-middle">'.$menu->getDescripcion().'</td>
			<td class="align-middle justify-content-center"><img src="'.$menu->getImagen().'" width=125></td>
			<td class="align-middle">$'.$menu->getPrecio().'</td>
			<td class="align-middle">'.$menu->getCantidad().'</td>
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
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
			</div>
		</div>
		</div>';
}