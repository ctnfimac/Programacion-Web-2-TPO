<?php 

class Menu{
	private $id;
	private $descripcion;
	private $imagen;

	public function __construct($id,$descripcion,$imagen){
		$this->id = $id;
		$this->descripcion = $descripcion;
		$this->imagen = $imagen;
	}

	public function getId(){
		return $this->id;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function getImagen(){
		return $this->imagen;
	}
}