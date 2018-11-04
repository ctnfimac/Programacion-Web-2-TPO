<?php

require_once('Usuario.php');

class Comercio extends Usuario{
	private $id_comercio;
	private $cuit;
	// private $id_comercio;

	public function __construct($id,$nombre,$apellido,
				$email,$contrasenia,$telefono,$cuit,$habilitado){
		parent::__construct($id,$nombre,$apellido,$email,$contrasenia,$telefono,$habilitado);
		$this->id_comercio = $id;
		$this->cuit = $cuit;
	}

	public function getIdComercio(){
		return $this->id_comercio;
	}

	public function getCuit(){
		return $this->cuit;
	}
}