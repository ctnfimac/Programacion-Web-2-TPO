<?php

class Router{
	private $route = 'home';

	public function __construct($route){
		$session = new SessionController();
		$usuario = $session->iniciarSession();
		//echo $usuario == true ? 'existe' : 'no existe';
		//echo '<br>' .$_SESSION['admin'] . '<br>';
		//$this->route = ($usuario == true && $route == 'admin' )? 'admin' : $route;
		$route = $session->getRuta() != null ? $session->getRuta() : $route;
		//$route = isset($_SESSION['usuario']) ?  $_SESSION['usuario'] : $route;
		//echo 'route: ' . $route . '<br>';
		$this->route($route,$usuario);
		//echo 'route: ' . $this->route;
		$view_controller = new ViewController($this->route);
		$operacion = (isset($_GET['operacion'])) ? $_GET['operacion'] : '';
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
					default:
						$seccion = new MenuModel();
						break;
				}
				if(isset($_GET['habilitar'])) $seccion->habilitar($_GET['habilitar']);
				$seccion->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $seccion->ejecutarOperacion();
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
				switch($opcion){
					case 'repartidor':
						$seccion = new RepartidorModel();
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
			case 'registrar':
				if($_POST['opcion'] == 1 ) $usuario = new ClienteModel();
				if($_POST['opcion'] == 2 ) $usuario = new RepartidorModel();
				if($_POST['opcion'] == 3 ) $usuario = new ComercioModel();
				$usuario->setOperacion($operacion);
				$usuario->ejecutarOperacion();
				header('location:index.php');
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
		//$this->route = 'home';
		if($usuario == true && $route == 'admin')  $this->route = $route;
		if($usuario == false && $route != 'admin') $this->route = $route;
		if($usuario == false && $route == 'admin') $this->route = 'home';
		if($usuario == true && $route != 'admin')  $this->route = $route;
		if(isset($_SESSION['usuario']) && $route == 'admin') $this->route = $_SESSION['usuario'];
		if(isset($_SESSION['usuario']) && $route == 'comercio') $this->route = $_SESSION['usuario'];
		if(isset($_SESSION['repartidor']) && $route == 'repartidor') $this->route = $_SESSION['usuario'];
		//echo $_SESSION['usuario'] , $this->route , $route ;
		//$this->route = ($usuario == true && $route == 'admin' )? 'admin' : $route;
	}
}