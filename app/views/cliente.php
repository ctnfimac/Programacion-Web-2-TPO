<?php

// if(isset($_GET['tabla']) && $_GET['tabla'] == 'clientes'){
require_once('cliente/sections/pedidos.php');
// 	//printf($tablaMenus);	
// }else
if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos'){
	require_once('repartidor/sections/pedidos_realizados.php');
}

printf($tablaPedidos);
// }else{
// 	require_once('repartidor/sections/estado.php');
// 	printf($estado,$actividad);
// }