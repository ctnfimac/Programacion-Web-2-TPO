<?php

class Usuario{
	private $id;
	private $nombre;
	private $apellido;
	private $email;
	private $contrasenia;
	private $telefono;
	private $habilitado;

	public function __construct($id,$nombre,$apellido,
						$email,$contrasenia,$telefono,$habilitado){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->email = $email;
		$this->contrasenia = $contrasenia;
		$this->telefono = $telefono;
		$this->habilitado = $habilitado;					
	}

	public function getId(){
		return $this->id;
	}

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
		return $this->telefono;
	}

	public function getHabilitado(){
		return $this->habilitado;
	}
}