<?php

class Usuario{
	//private $id;
	private $nombre;
	private $apellido;
	private $email;
	private $contrasenia;
	private $Telefono;

	public function __construct(/*$id,*/$nombre,$apellido,
						$email,$contrasenia,$telefono){
		//$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->email = $email;
		$this->contrasenia = $contrasenia;
		$this->Telefono = $Telefono;					
	}

	// public function getId(){
	// 	return $this->id;
	// }

	public function getNombre(){
		return $this->nombre;
	}

	public function getApellido(){
		return $this->apellido;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getContrasenia(){
		return $this->contrasenia;
	}

	public function getTelefono(){
		return $this->Telefono;
	}
}