<?php

class Oferta{
	private $id;
	private $fecha;
	private $id_menu;

	public function __construct($id, $fecha, $id_menu){
		$this->id = $id;
		$this->fecha = $fecha;
		$this->id_menu = $id_menu;
	}

	public function getId(){
		return $this->id;
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function getIdMenu(){
		return $this->id_menu;
	}
}