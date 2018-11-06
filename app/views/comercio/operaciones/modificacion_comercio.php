<?php

echo'
	<div class="container mt-4 mb-3">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-6 ">
				<div class="card p-4">
				<h2 class="text-center">Modificación del Comercio</h2>
				<form action="index.php?route=comercio&opcion=comercio&operacion=modificar" method="POST" enctype="multipart/form-data">
					<div class="form-group d-flex align-items-center">
						<input type="hidden" class="form-control" name="id" value="'.$_GET['id'].'">				
					</div>
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" name="nombre" placeholder="'.$_GET['nombre'].'">
						<input type="hidden" class="form-control" name="nombreActual" value="'.$_GET['nombre'].'">	
					</div>
					<!--<div class="form-group">
						<label for="apellido">Apellido</label>
						<input type="text" class="form-control" name="apellido" placeholder="'.$_GET['apellido'].'">
						<input type="hidden" class="form-control" name="apellidoActual" value="'.$_GET['apellido'].'">	
					</div>-->
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="'.$_GET['email'].'">
						<input type="hidden" class="form-control" name="emailActual" value="'.$_GET['email'].'">	
					</div>
					<div class="form-group">
						<label for="telefono">Telefono</label>
						<input type="text" class="form-control" name="telefono" placeholder="'.$_GET['telefono'].'">
						<input type="hidden" class="form-control" name="telefonoActual" value="'.$_GET['telefono'].'">	
					</div>
					<div class="form-group">
						<label for="cuit">Cuit</label>
						<input type="text" class="form-control" name="cuit" placeholder="'.$_GET['cuit'].'">
						<input type="hidden" class="form-control" name="cuitActual" value="'.$_GET['cuit'].'">	
					</div>
					<input type="submit" value="Modificar" class="btn btn-primary">
					<a class="btn bg-warning text-white" href="index.php?route=comercio&tabla=comercios">Cancelar</a>
				</form>
				</div>
			</div>
		</div>
	</div>
';