<?php

require_once('Usuario.php');

class Cliente extends Usuario{
	private $id;
	private $calle;
	private $numero;
	private $localidad;
	// private $id_usuario;

	public function __construct($id_usuario,$nombre,$apellido,
				$email,$contrasenia,$telefono,$calle,
				$numero,$localidad,$habilitado){
		parent::__construct($id_usuario,$nombre,$apellido,$email,$contrasenia,$telefono,$habilitado);
		$this->calle = $calle;
		$this->numero = $numero;
		$this->localidad = $localidad;
	}

	public function setId($id){
		$this->id = $id;
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