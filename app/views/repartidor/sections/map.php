<?php

$map = '
		
		<div class="card mb-3">
			<div class="card-body">
				<div class="d-md-flex justify-content-md-around">
					<div class="alert alert-dismissible alert-success">
						<strong>Tiempo de demora: </strong><span id="tiempoEnAuto"></span>.
					</div>

					<div class="alert alert-dismissible alert-danger">
						<strong>Distancia aproximada: </strong><span id="distancia"></span>.
					</div>
				</div>
				
				<input type="hidden" class="form-control" name="destino" value="%s" id="destino">
				<div class="p-4 mapa" id="mapa" style="width: 100%%; height: 500px;">
				</div>
			</div>
		</div>';