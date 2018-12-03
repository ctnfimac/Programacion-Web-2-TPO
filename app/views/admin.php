<?php

if(isset($_GET['tabla']) && $_GET['tabla'] == 'menus'){
	require_once('admin/sections/menusTabla.php');
	printf($tablaMenus);	
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'clientes'){
	require_once('admin/sections/clientesTabla.php');
	printf($tablaClientes);
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'repartidores'){
	require_once('admin/sections/repartidorTabla.php');
	printf($tablaRepartidores);
}

elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'comercios'){
	require_once('admin/sections/comerciosTabla.php');
	printf($tablaComercios);
}
elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'solicitudes'){
	require_once('admin/sections/tablero.php');
	printf($tablero);
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'estadisticas'){
	require_once('admin/sections/estadisticas.php');
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'pedidos_finalizados'){
	require_once('admin/sections/pedidos_finalizados.php');
	printf($tablaPedidosFinalizados);

}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'liquidacion'){
	require_once('admin/sections/liquidacion.php');
	printf($tablaLiquidaciones);
}elseif(isset($_GET['tabla']) && $_GET['tabla'] == 'ganancias'){
	require_once('admin/sections/ganancias.php');
	printf($tablaGanancias);
}else{//(isset($_GET['tabla']) && $_GET['tabla'] == 'tabla_pedidos')
	require_once('admin/sections/tabla_pedidos.php');
	printf($tablaPedidos);
}/*else{
	require_once('admin/sections/tablero.php');
	printf($tablero);
}*/







	