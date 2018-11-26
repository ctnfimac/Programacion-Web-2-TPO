<?php

require_once('class/Pedido.php');

class PedidoModel extends Conexion{

	private $operacion;

	protected function alta(){
		//obtener id del comercio
		$menu = new MenuModel();
		foreach($_SESSION['carrito'] as $key => $value){
			$id_comercio = $menu->buscoIdDeComercioPorMenu($value['id']);
		}
		//obtener id del cliente
		$cliente = new ClienteModel();
		$id_cliente =  $cliente->buscarIdPorNombre($_SESSION['admin']);

		$precio = $_GET['precio_total'];
		//setear al repartidor cuando este acepte hacer la entrega

		$fecha = date("Y-m-d H:i:s",time());
		$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		$zonahoraria = date_default_timezone_get();
		//$fecha=date("Y-m-d H:i:s",time());
		$dia = date("Y-m-d",time());
		$hora = date("H:i:s",time());
		//completar la tabla pedido
		// $this->query = "INSERT INTO pedido(id_comercio,id_cliente,fecha_alta, hora_alta, precio)
		// 				VALUES ('$id_comercio','$id_cliente',CURDATE(), '$hora' , '$precio')";
		// $this->set_query();

		// $this->query = "SELECT id 
		// 				FROM pedido 
		// 				WHERE fecha_alta = '$dia' AND hora_alta = '$hora' 
		// 					  AND id_comercio = '$id_comercio' AND id_cliente='$id_cliente'";
		// $tabla = $this->get_query();
		// while($row = $tabla->fetch_assoc()){
		// 	$id_pedido = $row['id'];
		// }

		// // por cada menu agregar el menu y el id del menu
		// foreach($_SESSION['carrito'] as $key => $value){
		// 	$id_menu = $value['id'];
		// 	$cantidad = $value['cantidad'];
		// 	$this->query = "INSERT INTO pedido_menus(id_pedido,id_menu,cantidad)
		// 					VALUES ('$id_pedido','$id_menu','$cantidad')";
		// 	$this->set_query();
		// }
		// $_SESSION['carrito'] = null;
		
		//iniciar timer para la penalizacion
		/**nuevo */
		$comercio = $menu->buscoNombreDeComercioIdDeComercio($id_comercio);
		$cliente = $_SESSION['admin'];
        $this->query = "INSERT INTO pedido(comercio,cliente,fecha_alta, hora_alta, precio)
		 				VALUES ('$comercio','$cliente',CURDATE(), '$hora' , '$precio')";
		$this->set_query();

		$this->query = "SELECT id 
		 				FROM  pedido
		 				WHERE fecha_alta = '$dia' AND hora_alta = '$hora' 
		 					  AND comercio = '$comercio' AND cliente='$cliente'";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$id_reg_pedido = $row['id'];
		}

		foreach($_SESSION['carrito'] as $key => $value){
			// echo 'id: ' . $value['id'] . '<br>';
			$menu_aux = $menu->menuPorId($value['id']);
			$descripcion = $menu_aux->getDescripcion();
			$imagen = $menu_aux->getImagen();
			$price = $menu_aux->getPrecio();
			$cantidad = $value['cantidad'];

			$origen = $imagen;
			$destino = str_replace("menu/", "pedidos/", $menu_aux->getImagen());
			if(!file_exists ($destino)) 	copy($origen, $destino);

			$imagen = str_replace("menu/", "pedidos/", $imagen);
			// echo $descripcion . ', ' . $imagen . ', ' . $price . ', '. $cantidad . ', ' . $id_reg_pedido . '<br>';
			$this->query = "INSERT INTO pedido_menus(id,menu,imagen,precio,cantidad)
							VALUES ('$id_reg_pedido','$descripcion','$imagen','$price','$cantidad')";
			$this->set_query();			
		}
		$_SESSION['carrito'] = null;
		header('location:index.php?route=carrito');
	}

	protected function baja(){}
	protected function modificacion(){}

		

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	public function ejecutarOperacion(){
		$id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
		$resultado = $this->operacion;
		
		switch($this->operacion){
			case 'agregar':
				$this->alta();
				$resultado = '';
				break;
			case 'eliminar':
				$this->baja($id);
				$resultado = '';
				break;
			case 'modificar':
				$this->modificacion($id);
				$resultado = '';
				break;
			default :
				//echo 'no hago nada';
				break;
		}
		return $resultado;
	}

	public function mostrarPedidos(){
		// $matriz = array();
		// $contador = 0;

		// $this->query = "SELECT id, id_comercio, id_cliente, fecha_alta, hora_alta, id_repartidor ,precio,penalizado, estado
		// 				FROM pedido";
							 
		// $tabla = $this->get_query();
		// while($fila = $tabla->fetch_assoc()){
		// 	 $pedido = new Pedido($fila['id'],$fila['id_comercio'],$fila['id_cliente'],$fila['fecha_alta'],
		// 	 				  $fila['hora_alta'],$fila['id_repartidor'],$fila['precio'],$fila['penalizado'],$fila['estado']);
		// 	 $matriz[$contador] = $pedido;
		// 	 $contador++;
		// }
		// return $matriz;
		$matriz = array();
		$contador = 0;

		$this->query = "SELECT id, comercio, cliente, fecha_alta, hora_alta, repartidor ,precio,penalizado, estado
						FROM pedido";
							 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			// ($id, $comercio, $cliente, $fecha_alta, $hora_alta ,
			// 		$repartidor,$precio_total,$penalizado = 0.0, $estado_del_pedido = 1){
			 $RegistroDePedido = new Pedido($fila['id'],$fila['comercio'],$fila['cliente'],$fila['fecha_alta'],
			 				  $fila['hora_alta'],$fila['repartidor'],$fila['precio'],$fila['penalizado'],$fila['estado']);
			 $matriz[$contador] = $RegistroDePedido;
			 $contador++;
		}
		return $matriz;
	}

	public function mostrarPedidosPorComercio(){
		$matriz = array();
		$contador = 0;
		
		$comercio = $_SESSION['admin'];
		// $this->query = "SELECT id, id_comercio, id_cliente, fecha_alta, hora_alta, id_repartidor ,precio,estado
		// 				FROM pedido
		// 				WHERE id_comercio = (select id from usuario where nombre = '$comercio')";
		$this->query = "SELECT id, comercio, cliente, fecha_alta, hora_alta, repartidor,precio,estado
						FROM pedido
						WHERE comercio = '$comercio'";
							 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $pedido = new Pedido($fila['id'],$fila['comercio'],$fila['cliente'],$fila['fecha_alta'],
			 				  $fila['hora_alta'],$fila['repartidor'],$fila['precio'],'',$fila['estado']);
			 $matriz[$contador] = $pedido;
			 $contador++;
		}
		return $matriz;
	}

	public function mostrarPedidosPorCliente(){
		$matriz = array();
		$contador = 0;
		
		$cliente = $_SESSION['admin'];
		// $this->query = "SELECT p.id, p.id_comercio, p.id_cliente, p.fecha_alta, p.hora_alta, p.id_repartidor ,p.precio, p.estado
		// 				FROM pedido p
		// 				WHERE id_cliente = (select id from usuario where nombre = '$cliente')";
		$this->query = "SELECT id, comercio, cliente, fecha_alta, hora_alta, repartidor, precio, estado
						FROM pedido p
						WHERE cliente = '$cliente'";
							 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $pedido = new Pedido($fila['id'],$fila['comercio'],$fila['cliente'],$fila['fecha_alta'],
			 				  $fila['hora_alta'],$fila['repartidor'],$fila['precio'],'',$fila['estado']);
			 $matriz[$contador] = $pedido;
			 $contador++;
		}
		return $matriz;
	}

	public function getMenuDePedido($id_pedido){
		// $matriz = array();
		// $contador = 0;
		// $this->query = "SELECT m.id, m.descripcion, m.imagen, m.precio , m.id_comercio, pm.cantidad
		// 				FROM pedido_menus pm JOIN
		// 					 pedido p ON pm.id_pedido = p.id JOIN
		// 					 menu m ON m.id = pm.id_menu
		// 				WHERE p.id = '$id_pedido'";				 
		// $tabla = $this->get_query();
		// while($fila = $tabla->fetch_assoc()){
		// 	 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio'],
		// 	 				  $fila['id_comercio'],$fila['cantidad']);
		// 	 $matriz[$contador] = $menu;
		// 	 $contador++;
		// }
		// return $matriz;
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT id, menu, imagen, precio , cantidad
						FROM pedido_menus
						WHERE id = '$id_pedido'";				 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['menu'],$fila['imagen'],$fila['precio'],
			 				  '',$fila['cantidad']);
			 $matriz[$contador] = $menu;
			 $contador++;
		}
		return $matriz;
	}

	public function estadoPedidoTomar($id_pedido){
		$repartidor = $_SESSION['admin'];
		// $this->query = "UPDATE pedido SET estado = 2, id_repartidor = (SELECT id FROM usuario WHERE nombre = '$repartidor' ) 
		// 				WHERE id = '$id_pedido'";
		$this->query = "UPDATE pedido SET estado = 2, repartidor = '$repartidor' 
						WHERE id = '$id_pedido'";
		$this->set_query();
	}

	public function estadoPedidoCancelar($id_pedido){
		$this->query = "UPDATE pedido SET estado = 1, repartidor = null 
						WHERE id = '$id_pedido'";
		$this->set_query();
	}

	public function estadoPedidoFinalizar($id_pedido){
		$this->query = "UPDATE pedido SET estado = 3 
						WHERE id = '$id_pedido'";
		$this->set_query();
	}

	public function actualizarPenalizaciones(){
		$fecha = date("Y-m-d H:i:s",time());
		$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		
		$this->query = "SELECT * FROM pedido";
		$tabla = $this->get_query();
		//echo $tabla;
		while($row = $tabla->fetch_assoc()){
			//echo 'hora alta: ' . $row['hora_alta'] . '<br>';
			//echo 'hora actual: ' . date("H:i",time()) . '<br>';
			$minutos = $this->calcular_tiempo_trasnc(date("H:i",time()),$row['hora_alta']);
			//echo 'minutos transcurridos: ' . $minutos .'<br>';
			if($minutos > 30){ //si pasan 20 minutos hago la penalizacion
				$costo =  $row['precio'] * 0.005;
				$id_pedido = $row['id']; 
				$this->query = "UPDATE pedido SET penalizado = '$costo' WHERE id= '$id_pedido' ";
				$this->set_query();
			}
		}
	}

	public function calcular_tiempo_trasnc($hora1,$hora2){
		$separar[1]=explode(':',$hora1);
		$separar[2]=explode(':',$hora2);
	
		$total_minutos_trasncurridos[1] = ($separar[1][0] * 60) + $separar[1][1];
		$total_minutos_trasncurridos[2] = ($separar[2][0] * 60) + $separar[2][1];
		$total_minutos_trasncurridos = $total_minutos_trasncurridos[1]  - $total_minutos_trasncurridos[2];
		return $total_minutos_trasncurridos;
	}
}