<?php


if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_finalizados'){
	require_once('cliente/sections/pedidos_finalizados.php');
	printf($tablaPedidosFinalizados);
}else{
	require_once('cliente/sections/pedidos.php');
	printf($tablaPedidos);
}

