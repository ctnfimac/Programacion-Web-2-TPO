<?php

class Pedido{
	//definir constantes de porcentajes de penalizaciones 0.5 y 
	//definir constantes de estado del pedido
	private $fecha;
	private $hora;
	private $cliente;
	private $comercio;
	private $repartidor;
	private $penalizacion_por_demora = false;
	private $penalizacion_por_no_tomarPedido = false;
	private $costo_por_demora = 0;
	private $costo_por_no_tomarPedido = 0;
	private $estado_del_pedido = 1; // no tomado, en proceso, no tomado (0,1,2)
	private $precio_total;
	private $menus = array(); //array de id

	public function __construct($fecha, $hora, $cliente, $comercio, $repartidor,
					$precio_total, $menus){
		$this->fecha = $fecha;
		$this->hora = $hora;
		$this->cliente = $cliente;
		$this->comercio = $comercio;
		$this->repartidor = $repartidor;
		$this->precio_total = $precio_total;
		$this->menus = $menus;			
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function getHora(){
		return $this->hora;
	}

	public function getCliente(){
		return $this->cliente;
	}

	public function getComercio(){
		return $this->comercio;
	}

	public function getRepartidor(){
		return $this->repartidor;
	}

	public function setPenalizacionPorDemora($penalizacion_por_demora){
		$this->costo_por_demora = 0.05 * $this->precio_total;
		$this->penalizacion_por_demora = $penalizacion_por_demora;
	}

	public function getPenalizacionPorDemora(){
		return $this->penalizacion_por_demora;
	}

	public function setPenalizacionPorNoTomarPedido($penalizacion_por_no_tomarPedido){
		$this->costo_por_no_tomarPedido = 0.05 * $this->precio_total;
		$this->penalizacion_por_no_tomarPedido = $penalizacion_por_no_tomarPedido;
	}

	public function getPenalizacionPorNoTomarPedido(){
		return $this->penalizacion_por_no_tomarPedido;
	}

	public function getCostoPorDemora(){
		return $this->costo_por_demora;
	}

	public function getCostoPorNoTomarPedido(){
		return $this->costo_por_no_tomarPedido;
	}

	public function setEstadoDelPedido($estado_del_pedido){
		$this->estado_del_pedido = $estado_del_pedido;
	}
	
	public function getEstadoDelPedido(){
		return $this->estado_del_pedido;
	}
	
	public function getPrecioTotal(){
		return $this->precio_total;
	}

	public function getMenus(){
		return $this->menus;
	}


}