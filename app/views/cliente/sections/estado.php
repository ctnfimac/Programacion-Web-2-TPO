<?php

// $estadoActual = '';
$repartidorModel = new RepartidorModel();
// echo $repartidorModel->getEstado();
if( $repartidorModel->getEstado() == 0){
	$actividad = 'Inactivo';
}else{
	$actividad = 'Activo';
}

$estado = '
<!-- Icon Cards-->
<h2 class="text-center">Estado: %s</h2>
<div class="row d-flex justify-content-center">
	
	<div class="col-xl-3 col-sm-6 mb-3">
		<div class="card text-white bg-success o-hidden h-100">
			<div class="card-body">
					<div class="card-body-icon">
						<i class="fas fa-fw fa-shopping-cart"></i>
					</div>
				<div class="mr-5">ACTIVAR</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="index.php?route=repartidor&operacion=activar">
			<span class="float-left">Has click acá</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
	<div class="col-xl-3 col-sm-6 mb-3 ">
		<div class="card text-white bg-danger o-hidden h-100">
			<div class="card-body">
				<div class="card-body-icon">
					<i class="fas fa-fw fa-life-ring"></i>
				</div>
				<div class="mr-5">DESACTIVAR</div>
			</div>
			<a class="card-footer text-white clearfix small z-1" href="#">
			<span class="float-left">Has click acá!</span>
			<span class="float-right">
				<i class="fas fa-angle-right"></i>
			</span>
			</a>
		</div>
	</div>
</div>
';



