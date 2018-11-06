<?php

if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos'){
	require_once('repartidor/sections/pedidos.php');
	//printf($tablaMenus);	
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_realizados'){
	require_once('repartidor/sections/pedidos_realizados.php');
	//printf($tablaMenus);
}else{
	require_once('repartidor/sections/estado.php');
	printf($estado,$actividad);
}