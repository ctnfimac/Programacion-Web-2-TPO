<?php 

class Menu{
	private $id;
	private $descripcion;
	private $imagen;
	private $precio;

	public function __construct($id,$descripcion,$imagen,$precio){
		$this->id = $id;
		$this->descripcion = $descripcion;
		$this->imagen = $imagen;
		$this->precio = $precio;
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

	public function getPrecio(){
		return $this->precio;
	}
}