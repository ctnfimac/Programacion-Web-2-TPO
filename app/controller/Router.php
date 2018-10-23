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
				$view_controller->load_view('home');
				break;
			case 'admin':
				$operacion = (isset($_GET['operacion'])) ? $_GET['operacion'] : '';
				$operacion = $this->admin_operacion($operacion);
				$view_controller->load_view('admin',$operacion);
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


	private function admin_operacion($operacion){
		$menuModel = new MenuModel();
		if($operacion=='eliminar'){
			$menuModel->baja($_GET['id']);
			$operacion = '';
		}
		if($operacion=='agregar'){
			$menuModel->alta();
			$operacion = '';
		}
		if($operacion=='modificar'){
			$menuModel->modificacion();
			$operacion = '';
		}
		return $operacion;
	}
}