<?php
$menuModel = new MenuModel();
$menus = $menuModel->mostrarMenus();
$info = '';
foreach($menus as $menu){
	$info .= '<tr>
		<td>'.$menu->getId().'</td>
		<td>'.$menu->getDescripcion().'</td>
		<td class="align-middle justify-content-center"><img src="'.$menu->getImagen().'" width=125></td>
		<td>'.$menu->getComercio().'</td>
		<td>$'.$menu->getPrecio().'</td>
		<td class="align-middle">
		<div class="btn-group" role="group">
			<a href="index.php?route=admin&operacion=modificacion&descripcion='.$menu->getDescripcion().'&imagen='.$menu->getImagen().'&id='.$menu->getId().'&precio='.$menu->getPrecio().'&comercio='.$menu->getComercio().'" class="btn text-white btn-primary disabled">Modificar</a>
			<a href="index.php?route=admin&opcion=menu&operacion=eliminacion&descripcion='.$menu->getDescripcion().'&imagen='.$menu->getImagen().'&id='.$menu->getId().'&precio='.$menu->getPrecio().'&comercio='.$menu->getComercio().'" class="btn text-white btn-danger disabled">Eliminar</a>
		</div></td>
	</tr>';
}


$tablaMenus = '
<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
		<i class="fas fa-table"></i>
		Tabla de los Menus <a href="index.php?route=admin&operacion=agregacion" class="btn btn-success float-right disabled">agregar nuevo</a>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered text-center" id="dataTable" width="100%%" cellspacing="0">
			<thead>
				<tr>
				<th>id</th>
				<th>descripcion</th>
				<th>imagen</th>
				<th>comercio</th>
				<th>precio</th>
				<th>operación</th>
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

