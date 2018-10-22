<?php

class Router{
	private $route;

	public function __construct($route){
		$this->route = $route;
		$this->verificarSession();
		$view_controller = new ViewController($this->route);

		switch($this->route){
			case 'home':
				$view_controller->load_view('home');
				break;
			case 'admin':
				$operacion = (isset($_GET['operacion'])) ? $_GET['operacion'] : '';
				if($operacion=='eliminar'){
					$menuModel = new MenuModel();
					$menuModel->baja($_GET['id']);
					$operacion = '';
				}
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


	private function verificarSession(){
		session_start();
		if( isset($_POST['email']) && isset($_POST['password'])){
			$session = new SessionController();
			$usuario = $session->login($_POST['email'],$_POST['password']);
			if ($usuario != false) {
				$_SESSION['admin'] = $usuario;
				//$this->route = 'admin';
			} 
		}
		$this->route = !isset($_SESSION['admin']) ? 'home' : $this->route;
	}
}