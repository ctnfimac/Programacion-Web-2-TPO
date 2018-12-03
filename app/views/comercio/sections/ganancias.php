<?php

$liquidacionModel = new LiquidacionModel();
$liquidaciones = $liquidacionModel->mostrarMisLiquidaciones();////

$infoGanancias = '';
foreach($liquidaciones as $liquidacion){
	$infoGanancias .= '<tr>
		<td>'.$liquidacion->getPeriodo().'</td>
		<td>'.$liquidacion->getRemuneracion().'</td>
		<td>'.$liquidacion->getDescuento().'</td>
		<td>'.$liquidacion->getNeto().'</td>
	</tr>';
}

$tablaGanancias = '
<div class="row d-flex justify-content-center">
	<div class="card mb-3">
		<div class="card-header text-primary">
			<i class="fas fa-table"></i>
			Ganancias mensuales
		</div>
		<div class="card-body">
			<div class="table-responsive text-center">
				<table class="table table-bordered" id="dataTable" width="100%%" cellspacing="0">
				<thead>
					<tr>
						<th>fecha</th>
						<th>remuneración</th>
						<th>descuento</th>
						<th>neto</th>
					</tr>
				</thead>
				<tbody>
					'.$infoGanancias.'			
				</tbody>
				</table>
			</div>
		</div>
		<!--<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
	</div>
';