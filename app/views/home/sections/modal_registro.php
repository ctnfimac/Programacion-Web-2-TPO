<?php 

$modal_registro = '
<div class="modal fade" id="modalLRFormDemo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">		
		<div class="modal-c-tabs">
			<ul class="nav nav-tabs tabs-2 light-blue darken-3" role="tablist">
				<li class="nav-item waves-effect waves-light">
					<a class="nav-link active" data-toggle="tab" href="#panel17" role="tab">
					<i class="fa fa-user mr-1"></i> Registro</a>
				</li>
				<!--<li class="nav-item waves-effect waves-light">
					<a class="nav-link active" data-toggle="tab" href="#panel18" role="tab">
					<i class="fa fa-user mr-1"></i> Registro</a>
				</li>-->
			</ul>
			<div class="tab-content">
			<form action="index.php?route=registrar&operacion=agregar" method="POST">
			<div class="tab-pane fade in show active" id="panel17" role="tabpanel">
				<div class="modal-body mb-1">
					<div class="md-form form-sm">
						<select class="browser-default custom-select mb-4"  name="opcion" id="tipoDeCliente" onchange="selectFunction()">
							<!--<option value="" disabled>Elija su opción</option>-->
							<option value="1" selected>Cliente</option>
							<option value="2">Delivery</option>	
							<option value="3">Comercio</option>				
						</select>
					</div>	 
				<div class="form-row">
					<div class="md-form form-sm">
						<i class="fa fa-user prefix" aria-hidden="true"></i>
						<input type="text" name="nombre" id="nombre" class="form-control form-control-sm">
						<label for="nombre">Nombre</label>
					</div>
					<div class="md-form form-sm">
						<!--<i class="fa fa-user prefix" aria-hidden="true"></i>-->
						<input type="text" name="apellido" id="apellido" class="form-control form-control-sm">
						<label for="apellido">Apellido</label>
					</div>
  				</div>
				<div class="md-form form-sm">
					<i class="fa fa-envelope prefix"></i>
					<input type="text" name="email" id="email" class="form-control form-control-sm" >
					<label for="email">Email</label>
				</div>

				<div class="md-form form-sm">
					<i class="fa fa-lock prefix"></i>
					<input type="password" name="pass" id="pass" class="form-control form-control-sm" requerid>
					<label for="pass">Contraseña</label>
				</div>
				<div class="md-form form-sm">
					<i class="fa fa-lock prefix"></i>
					<input type="password" name="pass2" id="pass2" class="form-control form-control-sm">
					<label for="pass2">Repita contraseña</label>
				</div>
				<div class="md-form form-sm">
					<i class="fa fa-phone prefix"></i>
					<input type="text" name="telefono" id="telefono" class="form-control form-control-sm">
					<label for="telefono">Teléfono</label>
				</div>
				<div class="md-form form-sm" id="c-dni">
					<i class="fa fa-address-book prefix" aria-hidden="true"></i>
					<input type="text" name="dni" id="dni" class="form-control form-control-sm">
					<label for="dni">DNI</label>
				</div>
				<div class="md-form form-sm" id="c-cuit">
					<i class="fa fa-passport prefix" aria-hidden="true"></i>
					<input type="text" name="cuit" id="cuit" class="form-control form-control-sm">
					<label for="cuit">Cuit</label>
				</div>
				<!--<div class="md-form form-sm">
				<i class="fa fa-location-arrow prefix" aria-hidden="true"></i>
					<input type="text" name="calle" id="calle" class="form-control form-control-sm">
					<label for="calle">Calle</label>

					<input type="text" name="numer" id="numer" class="form-control form-control-sm">
					<label for="numer">Número</label>
				</div>-->
				<div class="md-form form-sm" id="c-localidad">
					<i class="fa fa-map-marker prefix" aria-hidden="true"></i>
					<input type="text" name="localidad" id="localidad" class="form-control form-control-sm">
					<label for="localidad">Localidad</label>
				</div>
				<div class="form-row" id="c-direccion">
					<div class="md-form form-sm">
						<i class="fa fa-location-arrow prefix" aria-hidden="true"></i>
						<input type="text" name="calle" id="calle" class="form-control form-control-sm">
						<label for="calle">Nombre de la Calle</label>
					</div>
					<div class="md-form form-sm">
						<i class="fa fa-location-arrow prefix" aria-hidden="true"></i>
						<input type="text" name="numero" id="numero" class="form-control form-control-sm">
						<label for="numero">Número de la calle</label>
					</div>
				</div>
				
				<div class="text-center mt-4">
					<button class="btn waves-effect btn-deep-orange">Registrarse
					<i class="fa fa-sign-in ml-1"></i>
					</button>
					<button class="btn btn-info waves-effect " data-dismiss="modal" aria-label="Close" class="">Salir
						<i class="fa fa-sign-noutml-1"></i>
					</button>
				</div>
				</form>
				</div>
			  </div>
			</div>
		</div>
	  </div>
	</div>
</div>
';
