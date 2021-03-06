<?php 

class Menu{
	private $id;
	private $descripcion;
	private $imagen;
	private $precio;
	private $comercio;

	private $cantidad; 

	public function __construct($id,$descripcion,$imagen,$precio,$comercio,$cantidad = 1){
		$this->id = $id;
		$this->descripcion = $descripcion;
		$this->imagen = $imagen;
		$this->precio = $precio;
		$this->comercio = $comercio;
		$this->cantidad = $cantidad;
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

	public function getComercio(){
		return $this->comercio;
	}

	public function getCantidad(){
		return $this->cantidad;
	}
}