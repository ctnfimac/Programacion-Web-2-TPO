<?php

class SessionController{
	private $session;
	private $ruta = null;

	public function __construct(){
		$this->session = new AdminModel();
		//$this->ruta = 'home';
		session_start();
	}

	public function iniciarSession(){
		if($this->verificarSession() == false) {
			$usuario_buscado = false;
				$recordarme = (isset($_POST['recordarme'])) ? 1 : 0 ;
				if(isset($_POST['email']) && isset($_POST['password'])){
					$usuario_buscado =  $this->session->buscarUsuario($_POST['email'],$_POST['password']);
					$this->ruta = $this->session->getSeccion();
					if($usuario_buscado != false) {
						$_SESSION['admin'] = $usuario_buscado ;
						if($_SESSION['usuario'] == 'repartidor'){
							$repartidorModel = new RepartidorModel();
							$repartidorModel->activar();
						}
						if($recordarme == 1) setcookie("session",$usuario_buscado , time()+30);
					}
				}
			return $usuario_buscado;
		}else return true;
	}

	public function getRuta(){
		return $this->ruta;
	}

	private function verificarSession(){
		$resultado = isset($_SESSION['admin']) ? true : false;

		if(isset($_COOKIE['session']) && !isset($_SESSION['admin'])){
			$_SESSION['admin'] = $_COOKIE['session'];
			$resultado = true;
		}
		return $resultado;
	}

	public function logout(){
		session_start();
		if($_SESSION['usuario'] == 'repartidor'){
			$repartidorModel = new RepartidorModel();
			$repartidorModel->desactivar();
		}
		session_unset();
		session_destroy();
		setcookie ("session", "", time() - 3600);
		header('location: ./');
	}
}