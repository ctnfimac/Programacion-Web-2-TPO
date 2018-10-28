<?php

class CarritoModel{

	private $operacion;
	private $sumaParcial = 0;
	//private $listaProductos; //= array();
	//private $listaCantidad; //= array();

	public function __construct(){
		if(!isset($_SESSION['carrito'])) $_SESSION['carrito'] = array();
		//if(empty($_SESSION['carrito'])) echo 'vacio';
		//echo sizeof($_SESSION['carrito'] );
	}

	public function setOperacion($operacion){
		$this->operacion = $operacion;
		// $id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
		// echo 'operacion: ' .$operacion. ', id: ' . $id;	
	}

	public function ejecutarOperacion(){
		$id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
		//echo 'operacion: ' .$this->operacion. ', id: ' . $id;
	
		switch($this->operacion){
			case 'agregar':
				$this->agregarMenuNuevoAlCarrito($id);
				$resultado = '';
				break;
			case 'eliminar':
				$this->eliminarProductoDelCarrito($id);
				$resultado = '';
				break;
			// case 'precioParcial':
			// 	$this->precioParcialDelCarrito();
			// 	$resultado = '';
			// 	break;
			case 'incrementar':
				$this->aumentarCantidadDelProducto();
				break;
			case 'decrementar':
				$this->disminuirCantidadDelProducto();
				break;
			case 'precioTotal':
				$this->precioTotalDelCarrito();
				$resultado = '';
				break;
			default :
			    //echo 'no hago nada';
				break;
		}
	}

	private function agregarMenuNuevoAlCarrito($id){
		//verifico que no exista en la session
		if(!$this->existeElProductoEnElCarrito($id)){
			$itemNuevo = array('id' => $id , 'cantidad' => 1);
			$arrayNuevo = array();
			foreach($_SESSION['carrito'] as $clave => $valor){
				array_push($arrayNuevo,$valor); // relleno arrayNuevo con los arrays de la session
			}
			array_push($arrayNuevo,$itemNuevo); // agrego a arraynuevo el array nuevo creado
			$_SESSION['carrito'] = $arrayNuevo;
		}
	
	}

	private function eliminarProductoDelCarrito($id){
		$arrayNuevo = array();
		foreach($_SESSION['carrito'] as $clave => $valor){
			if($valor['id'] != $id)array_push($arrayNuevo,$valor);
		}
		$_SESSION['carrito'] = $arrayNuevo;	
 	}

	public function precioParcialDelCarrito(){
		// traigo productos
		$MenuModel = new MenuModel();
		$this->sumaParcial = 0;
		foreach($_SESSION['carrito'] as $clave => $valor){
			// if($valor['id'] == $id) $existe_producto = true;
			$this->sumaParcial = $this->sumaParcial + ( $MenuModel->precioPorId($valor['id']) * $valor['cantidad'] );
		}
		//$MenuModel->precioPorId(7);
		// voy sumando
		return $this->sumaParcial;
	}

	private function aumentarCantidadDelProducto(){
		if(isset($_GET['id'])){
			$arrayNuevo = array();
			foreach($_SESSION['carrito'] as $clave => $valor){
				if($valor['id'] == $_GET['id'] ){
					$contador = ($valor['cantidad'] < 10)? $valor['cantidad'] + 1 : $valor['cantidad'];
					$valor = array('id' => $_GET['id'] , 'cantidad' => $contador);
				}
				array_push($arrayNuevo,$valor);	
			}
			$_SESSION['carrito'] = $arrayNuevo;
		
			// imprimo en pantalla
			// foreach($_SESSION['carrito'] as $clave => $valor){
			// 	echo 'id: ' . $valor['id'] . ', cantidad: '. $valor['cantidad'] . '<br>' ;
			// }
		}
	}

	private function disminuirCantidadDelProducto(){
		if(isset($_GET['id'])){
			$arrayNuevo = array();
			foreach($_SESSION['carrito'] as $clave => $valor){
				if($valor['id'] == $_GET['id'] ){
					$contador = ($valor['cantidad'] > 1)? $valor['cantidad'] - 1 : $valor['cantidad'];
					$valor = array ('id' => $_GET['id'] , 'cantidad' => $contador);
				}
				array_push($arrayNuevo,$valor);	
			}
			$_SESSION['carrito'] = $arrayNuevo;
		
			//imprimo en pantalla
			// foreach($_SESSION['carrito'] as $clave => $valor){
			// 	echo 'id: ' . $valor['id'] . ', cantidad: '. $valor['cantidad'] . '<br>' ;
			// }
		}
	}

	private function existeElProductoEnElCarrito($id){
		$existe_producto = false;
		//if(isset($_SESSION['carrito'] )){
			foreach($_SESSION['carrito'] as $clave => $valor){
				if($valor['id'] == $id) $existe_producto = true;
			}
		//}
		return $existe_producto;
	}

	public function divercidadDeMenues(){
		// return (!empty($_SESSION['carrito'])) ? 0 : sizeof($_SESSION['carrito']);
		$contador = 0;
		if(isset($_SESSION['carrito'])){
			foreach($_SESSION['carrito'] as $dato)
				$contador++;
		}
		//return sizeof($_SESSION['carrito']);
		return $contador;
	}
}