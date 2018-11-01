<?php

class Router{
	private $route;

	public function __construct($route){
		$session = new SessionController();
		$usuario = $session->iniciarSession();
		$this->route = ($usuario == true && $route == 'admin' )? 'admin' : $route;
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
				$menuModel = new MenuModel();
				$menuModel->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $menuModel->ejecutoOperacion();
				$view_controller->load_view('admin',$operacion_ejecutada);
				break;
			case 'registrar':
				if($_POST['opcion'] == 1 ) $usuario = new ClienteModel();
				if($_POST['opcion'] == 2 ) $usuario = new DeliveryModel();
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

}