<?php 

$repartidorModel = new RepartidorModel();
$repartidores = $repartidorModel->mostrarRepartidores();

$infoRepartidores = '';
foreach($repartidores as $repartidor){
	$habilitado = $repartidor->getHabilitado() == 1 ? 'Si' : 'No';
	$estado= $repartidor->getEstado() == 1 ? 'Si' : 'No';
	if(!$repartidor->getHabilitado()){
		$btn = '<a href="index.php?route=admin&opcion=repartidor&habilitar=1&id='.$repartidor->getId().'." class="btn text-white btn-success">Habilitar</a>';
	}else{
		$btn = '<a href="index.php?route=admin&opcion=repartidor&habilitar=0&id='.$repartidor->getId().'." class="btn text-white btn-warning">Desabilitar</a>';
	}
	$infoRepartidores .= '<tr>
		<td>'.$repartidor->getId().'</td>
		<td>'.$repartidor->getNombre().'</td>
		<td>'.$repartidor->getApellido().'</td>
		<td>'.$repartidor->getEmail().'</td>
		<td>'.$repartidor->getTelefono().'</td>
		<td>'.$repartidor->getFechaNacimiento().'</td>
		<td>'.$repartidor->getDni().'</td>
		<td>'.$repartidor->getCuil().'</td>
		<td>'.$estado.'</td>
		<td>'.$habilitado.'</td>
		<td class="align-middle">
			<div class="btn-group" role="group">
				<a href="index.php?route=admin&opcion=repartidor&operacion=eliminacion&nombre='.$repartidor->getNombre().'&apellido='.$repartidor->getApellido().'&email='.$repartidor->getEmail().
							'&telefono='.$repartidor->getTelefono().'&fecha_nacimiento='.$repartidor->getFechaNacimiento().'&dni='.$repartidor->getDni().
							'&cuil='.$repartidor->getCuil().'&id='.$repartidor->getId().'." class="btn text-white btn-danger">Eliminar</a>
				<a href="index.php?route=admin&opcion=repartidor&operacion=modificacion&nombre='.$repartidor->getNombre().'&apellido='.$repartidor->getApellido().'&email='.$repartidor->getEmail().
							'&telefono='.$repartidor->getTelefono().'&fecha_nacimiento='.$repartidor->getFechaNacimiento().'&dni='.$repartidor->getDni().
							'&cuil='.$repartidor->getCuil().'&id='.$repartidor->getId().'." class="btn text-white btn-primary">Modificar</a>
				'.$btn.'
			</div>
		</td>
	</tr>';
}

$tablaRepartidores = '
	<div class="card mb-3">
		<div class="card-header text-primary">
			<i class="fas fa-table"></i>
			Tabla de Repartidores
		</div>
		<div class="card-body">
			<div class="table-responsive text-center">
				<table class="table table-bordered" id="dataTable" width="100%%" cellspacing="0">
				<thead>
					<tr>
						<th>id</th>
						<th>nombre</th>
						<th>apellido</th>
						<th>email</th>
						<th>teléfono</th>
						<th>fecha de nacimiento</th>
						<th>d.n.i</th>
						<th>CUIL</th>
						<th>activo</th>
						<th>habilitado</th>
						<th>Operación</th>
					</tr>
				</thead>
				<tbody>
					'.$infoRepartidores.'			
				</tbody>
				</table>
			</div>
		</div>
		<!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
	</div>
';