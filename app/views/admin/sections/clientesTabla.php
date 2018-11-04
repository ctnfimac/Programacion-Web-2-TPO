<?php 

$clienteModel = new ClienteModel();
$clientes = $clienteModel->mostrarClientes();

$infoClientes = '';
foreach($clientes as $cliente){
	$habilitado = $cliente->getHabilitado() == 1 ? 'Si' : 'No';
	$infoClientes .= '<tr>
		<td>'.$cliente->getId().'</td>
		<td>'.$cliente->getNombre().'</td>
		<td>'.$cliente->getApellido().'</td>
		<td>'.$cliente->getEmail().'</td>
		<td>'.$cliente->getContrasenia().'</td>
		<td>'.$cliente->getTelefono().'</td>
		<td>'.$cliente->getCalle().'</td>
		<td>'.$cliente->getNumero().'</td>
		<td>'.$cliente->getLocalidad().'</td>
		<td>'.$habilitado.'</td>
		<td class="align-middle">
			<div class="btn-group" role="group">
				<a href="index.php?route=admin&opcion=cliente&operacion=eliminacion&nombre='.$cliente->getNombre().'&apellido='.$cliente->getApellido().'&email='.$cliente->getEmail().
							'&telefono='.$cliente->getTelefono().'&calle='.$cliente->getCalle().'&numero='.$cliente->getNumero().
							'&localidad='.$cliente->getLocalidad().'&id='.$cliente->getId().'." class="btn text-white btn-danger">Eliminar</a>
				<a href="index.php?route=admin&opcion=cliente&operacion=modificacion&nombre='.$cliente->getNombre().'&apellido='.$cliente->getApellido().'&email='.$cliente->getEmail().
							'&telefono='.$cliente->getTelefono().'&calle='.$cliente->getCalle().'&numero='.$cliente->getNumero().
							'&localidad='.$cliente->getLocalidad().'&id='.$cliente->getId().'." class="btn text-white btn-primary">Modificar</a>
			</div>
		</td>
	</tr>';
}

$tablaClientes = '
<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header text-primary">
			<i class="fas fa-table"></i>
			Tabla de clientes
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
				<th>calle</th>
				<th>número</th>
				<th>localidad</th>
				<th>habilitado</th>
				<th>operación</th>
				</tr>
			</thead>
			<tbody>
			    '.$infoClientes.'			
			</tbody>
			</table>
		</div>
		</div>
		<!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
	</div>
';