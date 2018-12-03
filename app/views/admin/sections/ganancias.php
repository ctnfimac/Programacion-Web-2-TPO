<?php

$liquidacionModel = new LiquidacionModel();
$liquidaciones = $liquidacionModel->gananciasDeLaApp();

$infoGanancias = '';
while($liquidacion = $liquidaciones->fetch_assoc() ){
	$infoGanancias .= '<tr>
		<td>'.$liquidacion['fecha'].'</td>
		<td>'.$liquidacion['monto'].'</td>
	</tr>';
}

$tablaGanancias = '
<div class="row d-flex justify-content-center">
	
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-success o-hidden h-100">
			<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-shopping-cart"></i>
					</div>
				<div class="mr-5">REALIZAR LIQUIDACIONES</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="index.php?route=admin&opcion=liquidacion&operacion=agregar">
			<span class="float-left">Has click acá</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
</div>
	<div class="card mb-3">
		<div class="card-header text-primary">
			<i class="fas fa-table"></i>
			Mis Ganancias
		</div>
		<div class="card-body">
			<div class="table-responsive text-center">
				<table class="table table-bordered" id="dataTable" width="100%%" cellspacing="0">
				<thead>
					<tr>
						<th>fecha</th>
						<th>ganancia</th>
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