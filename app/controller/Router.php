<?php

class Router{

	public function __construct($route){

		session_start();

		//if(!isset($_SESSION['admin'])) $_SESSION['admin'] = false;

		if( isset($_POST['email']) && isset($_POST['password'])){
			echo 'verificando usuario', 'usuario: ' . $_POST['email'] , ', pass : ' . $_POST['password'];
			$admin = new AdminModel();
			$email = $admin->buscarAdministrador($_POST['email'],$_POST['password']);
			if ($email != false) {
				$_SESSION['admin'] = $email;
				header('location:index.php?route=admin');
				//echo '<br>usuario ' .$_SESSION['admin'];
			} 
			//else echo 'usuario inexistente';
		}
		//echo '<br>usuario ' .$_SESSION['admin'];
		$route = !isset($_SESSION['admin']) ? 'home' : $route;
		//echo 'route:', $route;
		//if(!$_SESSION['admin']){
			$view_controller = new ViewController($route);

			switch($route){
				case 'home':
					$view_controller->load_view('home');
					break;
				case 'admin':
					$view_controller->load_view('admin');
					break;
				default:
					echo 'error 404, pagina no encontrada';
					break; 
			}
		//}
	}
}