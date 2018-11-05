<?php 

$comercioModel = new ComercioModel();
$Comercios = $comercioModel->mostrarComercios();

$infoComercios = '';
foreach($Comercios as $comercio){
	$habilitado = $comercio->getHabilitado() == 1 ? 'Si' : 'No';
	if(!$comercio->getHabilitado()){
		$btn = '<a href="index.php?route=admin&opcion=comercio&habilitar=1&id='.$comercio->getId().'." class="btn text-white btn-success">Habilitar</a>';
	}else{
		$btn = '<a href="index.php?route=admin&opcion=comercio&habilitar=0&id='.$comercio->getId().'." class="btn text-white btn-warning">Desabilitar</a>';
	}
	$infoComercios .= '<tr>
		<td>'.$comercio->getId().'</td>
		<td>'.$comercio->getNombre().'</td>
		<td>'.$comercio->getApellido().'</td>
		<td>'.$comercio->getEmail().'</td>
		<td>'.$comercio->getContrasenia().'</td>
		<td>'.$comercio->getTelefono().'</td>
		<td>'.$comercio->getCuit().'</td>
		<td>'.$habilitado.'</td>
		<td class="align-middle">
			<div class="btn-group" role="group">
				<a href="index.php?route=admin&opcion=comercio&operacion=eliminacion&nombre='.$comercio->getNombre().'&apellido='.$comercio->getApellido().'&email='.$comercio->getEmail().
							'&telefono='.$comercio->getTelefono().'&cuit='.$comercio->getCuit().'&id='.$comercio->getId().'." class="btn text-white btn-danger">Eliminar</a>
				<a href="index.php?route=admin&opcion=comercio&operacion=modificacion&nombre='.$comercio->getNombre().'&apellido='.$comercio->getApellido().'&email='.$comercio->getEmail().
							'&telefono='.$comercio->getTelefono().'&cuit='.$comercio->getCuit().'&id='.$comercio->getId().'." class="btn text-white btn-primary">Modificar</a>
				'.$btn.'
			</div>
		</td>
	</tr>';
}

$tablaComercios = '
	<div class="card mb-3">
		<div class="card-header text-primary">
			<i class="fas fa-table"></i>
			Tabla de Comercios
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
						<th>contrasenia</th>
						<th>teléfono</th>
						<th>CUIT</th>
						<th>habilitado</th>
						<th>Operación</th>
					</tr>
				</thead>
				<tbody>
					'.$infoComercios.'			
				</tbody>
				</table>
			</div>
		</div>
		<!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
	</div>
';