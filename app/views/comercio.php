<?php

if(isset($_GET['tabla']) && $_GET['tabla'] == 'menus'){
	require_once('comercio/sections/menusTabla.php');
	printf($tablaMenus);	
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_finalizados'){
	require_once('comercio/sections/pedidos_finalizados.php');
	printf($tablaPedidosFinalizados);
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'ganancias'){
	require_once('comercio/sections/ganancias.php');
	printf($tablaGanancias);	
}else{//if(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_realizados'){
	require_once('comercio/sections/pedidos_realizados.php');
	printf($tablaPedidos);
}
/*
elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'clientes'){
	require_once('comercio/sections/clientesTabla.php');
	printf($tablaClientes);
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'repartidores'){
	require_once('comercio/sections/repartidorTabla.php');
	printf($tablaRepartidores);
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'comercios'){
	require_once('comercio/sections/comerciosTabla.php');
	printf($tablaComercios);
}
elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'solicitudes'){
	require_once('comercio/sections/tablero.php');
	printf($tablero);
}else{
	require_once('comercio/sections/tablero.php');
	printf($tablero);
}*/
