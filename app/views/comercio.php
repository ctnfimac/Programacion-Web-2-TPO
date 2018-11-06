<?php

if(isset($_GET['tabla']) && $_GET['tabla'] == 'menus'){
	require_once('comercio/sections/menusTabla.php');
	printf($tablaMenus);	
}

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
}
