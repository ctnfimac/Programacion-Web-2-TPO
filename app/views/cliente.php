<?php

echo 'estoy en la vista de clientes';
// if(isset($_GET['tabla']) && $_GET['tabla'] == 'clientes'){
// 	require_once('repartidor/sections/clientes.php');
// 	//printf($tablaMenus);	
// }else
if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos'){
	require_once('repartidor/sections/pedidos_realizados.php');
}
	//printf($tablaMenus);
// }else{
// 	require_once('repartidor/sections/estado.php');
// 	printf($estado,$actividad);
// }