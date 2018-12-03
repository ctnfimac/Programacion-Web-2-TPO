<?php

class Liquidacion{
	private $id;
	private $nombre;
	private $periodo;
	private $remuneracion;
	private $descuento;
	private $neto;

	public function __construct($id, $nombre, $periodo, $remuneracion, $descuento, $neto){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->periodo = $periodo;
		$this->remuneracion = $remuneracion;
		$this->descuento = $descuento;
		$this->neto = $neto;
	}

	public function getId(){
		return $this->id;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getPeriodo(){
		return $this->periodo;
	}

	public function getRemuneracion(){
		return $this->remuneracion;
	}

	public function getDescuento(){
		return $this->descuento;
	}

	public function getNeto(){
		return $this->neto;
	}
}