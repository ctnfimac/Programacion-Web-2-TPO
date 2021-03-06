<?php

class Router{
	private $route = 'home';

	public function __construct($route){
		
		$session = new SessionController();
		$usuario = $session->iniciarSession();
		$route = $session->getRuta() != null ? $session->getRuta() : $route;
		$this->route($route,$usuario);
		$view_controller = new ViewController($this->route);
		$operacion = (isset($_GET['operacion'])) ? $_GET['operacion'] : '';
		$this->actualizarPedidos();
		switch($this->route){
			case 'home':
				$carrito = new CarritoModel();
				$carrito->setOperacion($operacion);
				$carrito->ejecutarOperacion();
				$view_controller->load_view('home');
				break;
			case 'carrito':
				$carrito = new CarritoModel();
				$carrito->setOperacion($operacion);
				$carrito->ejecutarOperacion();
				$view_controller->load_view('carrito');
				break;
			case 'admin':
				$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 'menu';
				$view_controller->set_section($opcion);
				switch($opcion){
					case 'cliente':
						$seccion = new ClienteModel();
						break;
					case 'repartidor':
						$seccion = new RepartidorModel();
						break;
					case 'comercio':
						$seccion = new ComercioModel();
						break;
					case 'menu':
						$seccion = new MenuModel();
						break;
					case 'liquidacion':
						$seccion = new LiquidacionModel();
						break;
					default:
						$seccion = new MenuModel();
						break;
				}
				if(isset($_GET['habilitar'])) $seccion->habilitar($_GET['habilitar']);
				$seccion->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $seccion->ejecutarOperacion();
				//echo 'operacion:'.$operacion_ejecutada ;
				$view_controller->load_view('admin',$operacion_ejecutada);
				break;
			case 'comercio':
				$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 'menu';
				$view_controller->set_section($opcion);
				switch($opcion){
					case 'comercio':
						$seccion = new ComercioModel();
						break;
					case 'menu':
						$seccion = new MenuModel();
						break;
					default:
						$seccion = new MenuModel();
						break;
				}
				if(isset($_GET['habilitar'])) $seccion->habilitar($_GET['habilitar']);
				$seccion->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $seccion->ejecutarOperacion();
				$view_controller->load_view('comercio',$operacion_ejecutada);
				break;
			case 'repartidor':
				$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 'menu';
				$view_controller->set_section($opcion);
				$seccion = new RepartidorModel();
				if(isset($_GET['habilitar'])) $seccion->habilitar($_GET['habilitar']);
				$seccion->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $seccion->ejecutarOperacion();
				$view_controller->load_view('comercio',$operacion_ejecutada);
				break;
			case 'cliente':
				$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 'menu';
				$view_controller->set_section($opcion);
				$seccion = new ClienteModel();
				$operacion_ejecutada = $seccion->ejecutarOperacion();
				$view_controller->load_view('cliente',$operacion_ejecutada);
				break;
			case 'registrar':
				if($_POST['opcion'] == 1 ) $usuario = new ClienteModel();
				if($_POST['opcion'] == 2 ) $usuario = new RepartidorModel();
				if($_POST['opcion'] == 3 ) $usuario = new ComercioModel();
				$usuario->setOperacion($operacion);
				$usuario->ejecutarOperacion();
				header('location:index.php');
				break;
			case 'pedido':
				$pedido= new PedidoModel();
				$pedido->setOperacion($operacion);
				$pedido->ejecutarOperacion();
				break;
			case 'salir':
				$session = new SessionController();
				$session->logout();
				break;
			default:
				echo 'error 404, pagina no encontrada';
				break; 
		}
	}

	private function route($route,$usuario){
		if($usuario == true && $route == 'admin')  $this->route = $route;
		if($usuario == false && $route != 'admin') $this->route = $route;
		if($usuario == false && $route == 'admin') $this->route = 'home';
		if($usuario == true && $route != 'admin')  $this->route = $route;
		if($usuario == false) $this->route = 'home';
		if($usuario == false && $route == 'carrito')  $this->route = $route;
		if($usuario == false && $route == 'registrar')  $this->route = $route;
		if(isset($_SESSION['usuario']) && $route == 'admin') $this->route = $_SESSION['usuario'];
		if(isset($_SESSION['usuario']) && $route == 'comercio') $this->route = $_SESSION['usuario'];
		if(isset($_SESSION['repartidor']) && $route == 'repartidor') $this->route = $_SESSION['usuario'];
		if(isset($_SESSION['usuario']) && $route == 'cliente') $this->route = 'home';
	}

	private function actualizarPedidos(){
		$pedido= new PedidoModel();
		$pedido->actualizarPenalizaciones();
	}
}