<?php


echo'
	<div class="container mt-4"">
		<div class="row justify-content-center">
			<div class="col-xs-12 col-md-6 ">
				<div class="card p-4">
				<h2 class="text-center">Modificación de Pokemon</h2>
				<form action="index.php?route=comercio&opcion=menu&operacion=modificar" method="POST" enctype="multipart/form-data">
					<div class="form-group d-flex align-items-center">
						<!--<label for="imgurl">Imágen</label>-->
						<input type="hidden" class="form-control" name="id" value="'.$_GET['id'].'">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="fileImagen" id="fileImagen" aria-describedby="inputGroupFileAddon01">
							<input type="hidden" name="fileImagenActual" value="'.$_GET['imagen'].'">
							<label class="custom-file-label" for="fileImagen">Elija Otra Imágen</label>
						</div>
						<img src="'.$_GET['imagen'].'" width="125">
						<!-- <input type="text" class="form-control" name="imagen" placeholder="'.$_GET['imagen'].'">-->				
					</div>
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
						<input type="text" class="form-control" name="descripcion" placeholder="'.$_GET['descripcion'].'">
						<input type="hidden" class="form-control" name="descripcionActual" value="'.$_GET['descripcion'].'">	
					</div>
					<div class="form-group">
						<label for="precio">Precio en pesos ($)</label>
						<input type="text" class="form-control" name="precio" placeholder="'.$_GET['precio'].'">
						<input type="hidden" class="form-control" name="precioActual" value="'.$_GET['precio'].'">	
					</div>
					<input type="submit" value="Modificar" class="btn btn-primary">
					<a class="btn bg-warning text-white" href="index.php?route=comercio&tabla=menus">Cancelar</a>
				</form>
				</div>
			</div>
		</div>
	</div>
';