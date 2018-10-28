<?php

class Router{
	private $route;

	public function __construct($route){
		$session = new SessionController();
		$usuario = $session->iniciarSession();
		$this->route = $usuario == true ? $route : 'home';
		$view_controller = new ViewController($this->route);

		switch($this->route){
			case 'home':
				$carrito = new CarritoModel();
				$operacion = (isset($_GET['operacion'])) ? $_GET['operacion'] : '';
				$carrito->setOperacion($operacion);
				$carrito->ejecutarOperacion();
				//echo $carrito->precioParcialDelCarrito();
				//echo $carrito->divercidadDeMenues();
				$view_controller->load_view('home');
				break;
			case 'admin':
				$menuModel = new MenuModel();
				$operacion = (isset($_GET['operacion'])) ? $_GET['operacion'] : '';
				$menuModel->setOperacion($operacion);// alta,baja,modificacion
				$operacion_ejecutada = $menuModel->ejecutoOperacion();
				$view_controller->load_view('admin',$operacion_ejecutada);
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