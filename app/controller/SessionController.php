<?php

class SessionController{
	private $session;

	public function __construct(){
		$this->session = new AdminModel();
	}

	public function login($email,$pass){
		return $this->session->buscarUsuario($email,$pass);
	}

	public function logout(){
		session_start();
		session_destroy();
		header('location: ./');
	}
}