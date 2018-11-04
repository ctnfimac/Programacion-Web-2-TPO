<?php

class Router{
	private $route = 'home';

	public function __construct($route){
		$session = new SessionController();
		$usuario = $session->iniciarSession();
		//echo $usuario == true ? 'existe' : 'no existe';
		//echo '<br>' .$_SESSION['admin'] . '<br>';
		//$this->route = ($usuario == true && $route == 'admin' )? 'admin' : $route;
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
				// if(!isset($_POST['opcion'])) $seccion = new MenuModel();
				// else{
				// 	//if($_POST['opcion'] == 1 ) $usuario = new ClienteModel();
				// 	if($_POST['opcion'] == 'cliente' ) $usuario = new ClienteModel();
				// 	//if($_POST['opcion'] == 3 ) $usuario = new ComercioModel();
				// }
				//echo 'opcion: ' . $opcion;
				$view_controller->set_section($opcion);
				switch($opcion){
					case 'cliente':
						$seccion = new ClienteModel();
						break;
					case 'repartidor':
						$seccion = new RepartidorModel();
						break;
					case 'comercio':
						break;
					default:
						$seccion = new MenuModel();
						break;
				}
				//$menuModel = new MenuModel();
				//$menuModel->setOperacion($operacion);// alta,baja,modificacion
				//$operacion_ejecutada = $menuModel->ejecutoOperacion();
				//$menuModel = new MenuModel();
				$seccion->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $seccion->ejecutarOperacion();
				$view_controller->load_view('admin',$operacion_ejecutada);
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
		//$this->route = ($usuario == true && $route == 'admin' )? 'admin' : $route;
	}
}