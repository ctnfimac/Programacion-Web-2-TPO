<?php

// if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos'){
// 	require_once('repartidor/sections/pedidos.php');
// 	//printf($tablaMenus);	
// }else
//if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_realizados'){
	require_once('repartidor/sections/pedidos_realizados.php');
	require_once('repartidor/sections/map.php');
	printf($tablaPedidos);

	//$_GET['direccion'] = 'estocolmo 1577, villa luzuriaga';
	$direccion = isset($_GET['direccion']) ? $_GET['direccion'] : '';
	//echo $direccion;
	printf($map,$direccion);
//}
// }else{
// 	require_once('repartidor/sections/estado.php');
// 	printf($estado,$actividad);
// }