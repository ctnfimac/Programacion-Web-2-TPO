<?php

require_once('class/Pedido.php');

class PedidoModel extends Conexion{

	private $operacion;

	public function mostrarPedidos(){
		
	}

	protected function alta(){
		//obtener nombre del comercio
		foreach($_SESSION['carrito'] as $key => $value){
		}
		//obtener id del cliente
		$cliente = new ClienteModel();
		$id_cliente =  $cliente->buscarIdPorNombre($_SESSION['admin']);
		echo 'id_cliente: ' . $id_cliente;


		//setear al repartidor cuando este acepte hacer la entrega

		//iniciar timer para la penalizacion
		echo 'estoy en agregar pedido';
	}

	protected function baja(){}
	protected function modificacion(){}

		

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	public function ejecutarOperacion(){
		$id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
		$resultado = $this->operacion;
		
		switch($this->operacion){
			case 'agregar':
				$this->alta();
				$resultado = '';
				break;
			case 'eliminar':
				$this->baja($id);
				$resultado = '';
				break;
			case 'modificar':
				$this->modificacion($id);
				$resultado = '';
				break;
			default :
				//echo 'no hago nada';
				break;
		}
		return $resultado;
	}
}