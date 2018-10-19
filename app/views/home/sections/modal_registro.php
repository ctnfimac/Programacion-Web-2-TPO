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
			</ul>
			<div class="tab-content">
			<div class="tab-pane fade in show active" id="panel17" role="tabpanel">
				<div class="modal-body mb-1">
					<div class="md-form form-sm">
							<select class="browser-default custom-select mb-4">
								<option value="" disabled>Elija su opción</option>
								<option value="1" selected>Comercio</option>
								<option value="2">Delivery</option>
								<option value="3">Cliente</option>
							</select>
							</div>	 
				<div class="md-form form-sm">
					<i class="fa fa-envelope prefix"></i>
					<input type="text" id="form2" class="form-control form-control-sm">
					<label for="form2">Your email</label>
				</div>

				<div class="md-form form-sm">
					<i class="fa fa-lock prefix"></i>
					<input type="password" id="form3" class="form-control form-control-sm">
					<label for="form3">Your password</label>
				</div>
				<div class="md-form form-sm">
					<i class="fa fa-lock prefix"></i>
					<input type="password" id="form6" class="form-control form-control-sm">
					<label for="form6">Repeat password</label>
				</div>
				<div class="md-form form-sm">
					<i class="fa fa-phone prefix"></i>
					<input type="Text" id="form71" class="form-control form-control-sm">
					<label for="form71">Teléfono</label>
				</div>
				<div class="text-center mt-4">
					<button class="btn waves-effect btn-deep-orange">Registrarse
					<i class="fa fa-sign-in ml-1"></i>
					</button>
					<button class="btn btn-info waves-effect " data-dismiss="modal" aria-label="Close" class="">Salir
						<i class="fa fa-sign-noutml-1"></i>
					</button>
				</div>
				</div>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>
';