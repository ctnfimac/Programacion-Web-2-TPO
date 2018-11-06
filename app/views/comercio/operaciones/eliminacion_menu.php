<?php

echo'
	<div class="container">
		<div class= "row justify-content-center mt-4">
		<div class="alert alert-dismissible alert-warning p-2">
			<h4 class="alert-heading">Precaución!</h4>
			<p class="mb-0">Realmente quiere eliminar el menu de la base de datos?
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Descripcion</th>
						<th scope="col">Precio</th>
						<th scope="col">Imagen</th>
				</thead>
				<tbody>
					<tr class="table-active">
						<td class="align-middle">'.$_GET['id'].'</td>
						<td class="align-middle">'.$_GET['descripcion'].'</td>
						<td class="align-middle">$'.$_GET['precio'].'</td>
						<td class="align-middle"><img src="'.$_GET["imagen"].'" width="120"></td>
					</tr>
				</tbody>
			</table>
			
			<a href="index.php?route=comercio&opcion=menu&operacion=eliminar&id='.$_GET['id'].'&imgUrl='.$_GET['imagen'].'" class="alert-link btn bg-success text-white">Aceptar</a>
			<a href="index.php?route=comercio&tabla=menus" class="alert-link btn bg-warning text-white">Cancelar</a>
		</div>
		</div> 
	</div>
	';

