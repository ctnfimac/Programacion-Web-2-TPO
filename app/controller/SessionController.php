<?php

class SessionController{
	private $session;

	public function __construct(){
		$this->session = new AdminModel();
		session_start();
	}

	public function iniciarSession(){
		if($this->verificarSession() == false) {
			$usuario_buscado = false;
				$recordarme = (isset($_POST['recordarme'])) ? 1 : 0 ;
				if(isset($_POST['email']) && isset($_POST['password'])){
					$usuario_buscado =  $this->session->buscarUsuario($_POST['email'],$_POST['password']);
					if($usuario_buscado != false) {
						$_SESSION['admin'] = $usuario_buscado ;
						if($recordarme == 1) setcookie("session",$usuario_buscado , time()+30);
					}
				}
			return $usuario_buscado;
		}else return true;
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
		session_destroy();
		setcookie ("session", "", time() - 3600);
		header('location: ./');
	}
}