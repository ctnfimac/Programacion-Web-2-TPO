<?php

$notificaciones = '
<!-- Icon Cards-->
<div class="row">
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-primary o-hidden h-100">
			<div class="card-body">
			<div class="card-body-icon">
				<i class="fas fa-fw fa-comments"></i>
			</div>
			<div class="mr-5">26 New Messages!</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
			<span class="float-left">View Details</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-warning o-hidden h-100">
			<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-list"></i>
					</div>
				<div class="mr-5">11 New Tasks!</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
			<span class="float-left">View Details</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-success o-hidden h-100">
			<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-shopping-cart"></i>
					</div>
				<div class="mr-5">123 New Orders!</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
			<span class="float-left">View Details</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-danger o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-life-ring"></i>
				</div>
				<div class="mr-5">13 New Tickets!</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
			<span class="float-left">View Details</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
</div>
';


$menuModel = new MenuModel();
$menus = $menuModel->mostrarMenus();
$info = '';
foreach($menus as $menu){
	$info .= '<tr>
		<td>'.$menu->getId().'</td>
		<td>'.$menu->getDescripcion().'</td>
		<td class="align-middle justify-content-center"><img src="'.$menu->getImagen().'" width=125></td>
		<td>$'.$menu->getPrecio().'</td>
		<td class="align-middle">
		<div class="btn-group" role="group">
			<a href="index.php?route=admin&operacion=modificacion&descripcion='.$menu->getDescripcion().'&imagen='.$menu->getImagen().'&id='.$menu->getId().'&precio='.$menu->getPrecio().'" class="btn text-white btn-primary">Modificar</a>
			<a href="index.php?route=admin&operacion=eliminacion&descripcion='.$menu->getDescripcion().'&imagen='.$menu->getImagen().'&id='.$menu->getId().'&precio='.$menu->getPrecio().'" class="btn text-white btn-danger">Eliminar</a>
		</div></td>
	</tr>';
}


$tabla = '
<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
		<i class="fas fa-table"></i>
		Tabla de los Menus <a href="index.php?route=admin&operacion=agregacion" class="btn btn-success float-right">agregar nuevo</a>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%%" cellspacing="0">
			<thead>
				<tr>
				<th>id</th>
				<th>descripcion</th>
				<th>imagen</th>
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

