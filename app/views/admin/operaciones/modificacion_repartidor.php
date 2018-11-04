<?php

echo'
	<div class="container mt-4 mb-3">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-6 ">
				<div class="card p-4">
				<h2 class="text-center">Modificación el cliente</h2>
				<form action="index.php?route=admin&opcion=repartidor&operacion=modificar" method="POST" enctype="multipart/form-data">
					<div class="form-group d-flex align-items-center">
						<input type="hidden" class="form-control" name="id" value="'.$_GET['id'].'">				
					</div>
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" name="nombre" placeholder="'.$_GET['nombre'].'">
						<input type="hidden" class="form-control" name="nombreActual" value="'.$_GET['nombre'].'">	
					</div>
					<div class="form-group">
						<label for="apellido">Apellido</label>
						<input type="text" class="form-control" name="apellido" placeholder="'.$_GET['apellido'].'">
						<input type="hidden" class="form-control" name="apellidoActual" value="'.$_GET['apellido'].'">	
					</div>
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
						<label for="dni">Dni</label>
						<input type="text" class="form-control" name="dni" placeholder="'.$_GET['dni'].'">
						<input type="hidden" class="form-control" name="dniActual" value="'.$_GET['dni'].'">	
					</div>
					<div class="form-group">
						<label for="cuil">Cuil</label>
						<input type="text" class="form-control" name="cuil" placeholder="'.$_GET['cuil'].'">
						<input type="hidden" class="form-control" name="cuilActual" value="'.$_GET['cuil'].'">	
					</div>
					<div class="form-group">
						<label for="fecha_nacimiento">nacimiento</label>
						<input type="text" class="form-control" name="fecha_nacimiento" placeholder="'.$_GET['fecha_nacimiento'].'">
						<input type="hidden" class="form-control" name="nacimientoActual" value="'.$_GET['fecha_nacimiento'].'">	
					</div>
					<input type="submit" value="Modificar" class="btn btn-primary">
					<a class="btn bg-warning text-white" href="index.php?route=admin">Cancelar</a>
				</form>
				</div>
			</div>
		</div>
	</div>
';