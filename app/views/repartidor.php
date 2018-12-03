<?php

if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_finalizados'){
	require_once('repartidor/sections/pedidos_finalizados.php');
	printf($tablaPedidosFinalizados);
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'ganancias'){
	require_once('repartidor/sections/ganancias.php');
	printf($tablaGanancias);
}else{
	require_once('repartidor/sections/pedidos_realizados.php');
	require_once('repartidor/sections/map.php');
	printf($tablaPedidos);
	$direccion = isset($_GET['direccion']) ? $_GET['direccion'] : '';
	printf($map,$direccion);
}