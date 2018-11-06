<?php

echo'
	<div class="container">
		<div class= "row justify-content-center mt-4">
		<div class="alert alert-dismissible alert-warning p-2">
			<h4 class="alert-heading">Precaución!</h4>
			<p class="mb-0">Realmente quiere eliminar el comercio de la base de datos?
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>nombre</th>
						<th>apellido</th>
						<th>email</th>
						<th>teléfono</th>
						<th>cuit</th>
					</tr>
				</thead>
				<tbody>
					<tr class="table-active">
						<td>'.$_GET['nombre'].'</td>
						<td>'.$_GET['apellido'].'</td>
						<td>'.$_GET['email'].'</td>
						<td>'.$_GET['telefono'].'</td>
						<td>'.$_GET['cuit'].'</td>
					</tr>
				</tbody>
			</table>
			
			<a href="index.php?route=admin&opcion=comercio&operacion=eliminar&id='.$_GET['id'].'" class="alert-link btn bg-success text-white">Aceptar</a>
			<a href="index.php?route=admin&tabla=comercios" class="alert-link btn bg-warning text-white">Cancelar</a>
		</div>
		</div> 
	</div>
	';