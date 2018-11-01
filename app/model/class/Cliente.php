<?php

class Cliente extends Usuario{
	//private $id;
	private $calle;
	private $numero;
	private $localidad;
	// private $id_usuario;

	public function __construct($nombre,$apellido,
				$email,$contrasenia,$telefono,$calle,
				$numero,$localidad){
		parent::__construct($nombre,$apellido,$email,$contrasenia,$telefono);
		$this->calle = $calle;
		$this->numero = $numero;
		$this->localidad = $localidad;
	}

	public function getCalle(){
		return $this->calle;
	}

	public function getNumero(){
		return $this->numero;
	}

	public function getLocalidad(){
		return $this->localidad;
	}
}