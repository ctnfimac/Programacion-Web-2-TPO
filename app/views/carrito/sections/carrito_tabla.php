<?php

$menuModel = new MenuModel();
// $menus = $menuModel->mostrarMenus();
// foreach($menus as $menu){
	
// }

$items_carrito = '';
 foreach($_SESSION['carrito'] as $key => $value){
	$menu = $menuModel->menuPorId($value['id'] );
	$items_carrito .= '
		<tr>
			<td><img src="'.$menu->getImagen().'" width=125></td>
			<td class="align-middle">'.$menu->getDescripcion().'</td>
			<td class="align-middle">Comercio</td>
			<td>
			<div class="btn-group pt-4" role="group" aria-label="Basic example">
				<input type="text" class="text-center" value="'.$value['cantidad'].'" disabled>
				<a	href="index.php?route=carrito&operacion=incrementar&id='.$value['id'].'" type="button" class="btn btn-primary"><i class="fa fa-caret-up"></i></a>
				<a	href="index.php?route=carrito&operacion=decrementar&id='.$value['id'].'" type="button" class="btn btn-primary"><i class="fa fa-caret-down"></i></a>
			</div>
			</td>
			<td class="align-middle">'.$menu->getPrecio() * $value['cantidad'] .'</td>
			<td>
				<div class="btn-group pt-4" role="group">
					<a href="index.php?route=carrito&operacion=eliminar&id='.$value['id'].'" class="btn text-white btn-danger align-middle">Eliminar</a>
				</div>
			</td>
		</tr>		
	';
 }

$carrito_tabla = '
	<div class="mb-3">
		<h2 class="text-center mt-3 text-primary">Tús Menus</h2>
		<!--<div class="card-header">
		<i class="fas fa-table"></i>
			Tabla de Pedidos
		</div>-->
		<div class="card-body">
		<div class="table-responsive text-center">
			<table class="table table-bordered" id="dataTable" width="100%%" cellspacing="0">
			<thead>
				<tr>
				<th>Menu</th>
				<th>Descripcion</th>
				<th>Comercio</th>
				<th>Cantidad</th>
				<th>Precio($)</th>
				<th>Operación</th>
				</tr>
			</thead>
			<tbody>
 				%s
			</tbody>
			<thead>
				<tr>
				<th class="text-right text-2" colspan="4">TOTAL:</th>
				<th>'.$carrito->precioParcialDelCarrito().'</th>
				<th><button class="btn btn-default" class="text-right" type="button">Confirmar pedido</button></th>
				</tr>
			</thead>
			</table>
		</div>
		</div>
	</div>
	</div>';