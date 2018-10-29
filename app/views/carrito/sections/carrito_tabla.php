<?php

$menuModel = new MenuModel();
$menus = $menuModel->mostrarMenus();
foreach($menus as $menu){
	
}

$carrito_tabla = '
	<div class="card mb-3">
		<div class="card-header">
		<i class="fas fa-table"></i>
		Tabla de Pedidos
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%%" cellspacing="0">
			<thead>
				<tr>
				<th>Pedido</th>
				<th>Comercio</th>
				<th>Cantidad</th>
				<th>Precio</th>
				<th>Operación</th>
				</tr>
			</thead>
			<tbody>
			    <td><img src="'.$menu->getImagen().'" width=125></td>
			    <td>La Farola</td>
			    <td><div class="input-group spinner">
			      <div class="input-group-btn-vertical">
			        <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
			        <input type="text" class="form-control" value="1">
			        <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
			      </div>
			    </div>
			    </td>
			    <td>'.$menu->getPrecio().'</td>
			    <td><div class="btn-group" role="group">
			<a href="index.php?route=admin&operacion=eliminacion&descripcion='.$menu->getDescripcion().'&imagen='.$menu->getImagen().'&id='.$menu->getId().'&precio='.$menu->getPrecio().'" class="btn text-white btn-danger">Eliminar</a>
		</div></td>		
			</tbody>
			<thead>
				<tr>
				<th colspan="3" style="text-align:center">Total</th>
				<th>'.$menu->getPrecio().'</th>
				<th><button class="btn btn-default" type="button">Confirmar pedido</button></th>
				</tr>
			</thead>
			</table>
		</div>
		</div>
	</div>

	</div>';