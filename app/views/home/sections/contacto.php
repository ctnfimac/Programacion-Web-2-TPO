<?php

$contacto = '
<section id="contacto" class="mb-4">
	<h2 class="text-center">Contactos</h2>
	<p class="text-center">Su consulta no molesta</p>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-4">
				<form class="text-center border border-light p-5 mb-4">
					<p class="h4 mb-4">Contáctenos</p>
					<input type="text" id="defaultContactFormName" class="form-control mb-4" name="nombre" placeholder="Nombre">
					<input type="email" id="defaultContactFormEmail" class="form-control mb-4" name="email" placeholder="E-mail">
					<label>Subject</label>
					<select class="browser-default custom-select mb-4">
						<option value="" disabled>Elija su opción</option>
						<option value="1" selected>Feedback</option>
						<option value="2">Reportar mal servivio</option>
					</select>
					<div class="form-group">
						<textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" name="mensaje" placeholder="Mensaje"></textarea>
					</div>
					<div class="custom-control custom-checkbox mb-4">
						<input type="checkbox" class="custom-control-input" id="defaultContactFormCopy">
						<label class="custom-control-label" for="defaultContactFormCopy">Enviarme una copia de este mensaje</label>
					</div>
					<button class="btn btn-info btn-block" type="submit">Enviar</button>

				</form>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-8 mb-4">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.3987009069774!2d-58.564793985276864!3d-34.66988558044238!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcc62cc3e02599%%3A0x5f178c9d980d3f8b!2sFlorencio+Varela+1903%%2C+B1754JEC+San+Justo%%2C+Pcia+de+Buenos+Aires!5e0!3m2!1ses-419!2sar!4v1539750387378" width="100%%" height="565" frameborder="0" style="border:0" allowfullscreen></iframe>				
			</div>
		</div>
	</div>
</section>
';