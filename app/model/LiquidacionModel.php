<?php

require_once('class/Liquidacion.php');

class LiquidacionModel extends Conexion{

	private $operacion;

	protected function alta(){

		//no se puede realizar liquidacion si ya fue hecha o si no estamos en fecha
		// echo $this->sePuedeLiquidar() == true ? 'si se puede':'no se puede';
		//de pago o sea del 1 al 5

		// calcular el total recaudado en el mes de cada comercio
		if($this->sePuedeLiquidar()){
				// $this->query = "SELECT comercio, SUM(precio) total, CURDATE() fecha
				// 				FROM pedido
				// 				WHERE MONTH(fecha_alta) = MONTH(CURDATE())
				// 					AND estado = 3
				// 				GROUP BY comercio";
				$sueldo_app = 0;
				$sueldo_delivery = 0;


				$this->query = "SELECT comercio, SUM(precio) total, CURDATE() fecha
				 				FROM pedido
				 				WHERE fecha_alta >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and 
								  	  fecha_alta < CURDATE()
				 					  AND estado = 3
				 				GROUP BY comercio";
				$tabla = $this->get_query();
				$comercioModel = new ComercioModel();
				while($fila = $tabla->fetch_assoc()){
				// echo '<br>';
				$periodo = $fila['fecha'];
				$remuneracion = $fila['total'];
				$descuento = $fila['total'] * 0.08;

				$sueldo_app = $sueldo_app + $fila['total'] * 0.05;
				$sueldo_delivery =  $sueldo_delivery  + $fila['total'] * 0.03;

				$neto = $fila['total'] - $descuento;
				$id_comercio = $comercioModel-> obtenerIdDelComercio($fila['comercio'] );
				// echo 'perdiodo: ' . $fila['fecha'] .', remuneracion: ' . $fila['total'] . 
				// 	', descuento: ' . $descuento . ', id_comercio: ' . $id_comercio;
				$this->query = "INSERT INTO liquidacion(periodo_pago, remuneracion, descuento, neto, id_usuario)
								VALUES ('$periodo','$remuneracion','$descuento','$neto','$id_comercio')";
				$this->set_query();
			}
			$this->query = "INSERT INTO ganancia(fecha,monto) 
							VALUES (CURDATE(),'$sueldo_app')";
			$this->set_query();

			//para el delivery tengo que darle el 0.3% del pedido que realizo 
			
			$this->query = "SELECT repartidor, SUM(precio * 0.03 ) total, CURDATE() fecha
							FROM pedido
							WHERE fecha_alta >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and 
								  fecha_alta < CURDATE()
								  AND estado = 3
							GROUP BY repartidor";

			$tabla = $this->get_query();
			$comercioModel = new RepartidorModel();
			while($fila = $tabla->fetch_assoc()){
				$periodo = $fila['fecha'];
				$remuneracion = $fila['total'];
				$descuento = 0;
				$neto = $fila['total'] - $descuento;
				$id_repartidor = $comercioModel->obtenerIdDelRepartidor($fila['repartidor'] );
				$this->query = "INSERT INTO liquidacion(periodo_pago, remuneracion, descuento, neto, id_usuario)
								VALUES ('$periodo','$remuneracion','$descuento','$neto','$id_repartidor')";
				$this->set_query();
			}
		}
		
		header('location:index.php?route=admin&tabla=liquidacion');
	}
	protected function baja(){}
	protected function modificacion(){}

	private function sePuedeLiquidar(){
		$resultado = true;

		$fecha = date("Y-m-d",time());
		$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
		date_default_timezone_set('America/Argentina/Buenos_Aires');
		
		if(date("d")>1 && date("d")<= 5){ // si estoy dentro de los dias de liquidacion
			$this->query = "SELECT * 
						FROM liquidacion
						WHERE MONTH(periodo_pago) =  MONTH(CURDATE())";
			// $this->query = "SELECT * 
			//  				FROM liquidacion
			// 			 	WHERE periodo_pago >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) and 
			// 					  periodo_pago < CURDATE()";
						// AND DAY(periodo_pago) <= 5 and DAY(periodo_pago) >= 1
			$tabla = $this->get_query();
			while($fila = $tabla->fetch_assoc()){
					$resultado = false;
					break;
			}
		}else $resultado = false;
		
		return $resultado;
	}

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	public function ejecutarOperacion(){
		$resultado = $this->operacion;
		switch($resultado){
			case 'agregar':
				$this->alta();
				$resultado = '';
				break;
			case 'eliminar':
				$this->baja();
				$resultado = '';
				break;
			case 'modificar':
				$this->modificacion();
				$resultado = '';
				break;
		}
		return $resultado;//para que regrese al administrador
	}

	public function mostrarLiquidaciones(){
		$matriz = array();
		$contador = 0;
		//$id, $nombre, $periodo, $remuneracion, $descuento, $neto
		$this->query = "SELECT l.id, u.nombre, l.periodo_pago, l.remuneracion, l.descuento, l.neto 
						FROM liquidacion l JOIN
							usuario u ON l.id_usuario = u.id
						WHERE u.id not in(1,2,3)";
						//ORDER BY periodo"; //	
					 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $liquidacion = new Liquidacion($fila['id'],$fila['nombre'],$fila['periodo_pago'],$fila['remuneracion'],
			 				  $fila['descuento'],$fila['neto']);
			 $matriz[$contador] = $liquidacion;
			 $contador++;
		}
		return $matriz;
		
	}

	function mostrarMisLiquidaciones(){
		$matriz = array();
		$contador = 0;
		$nombre = $_SESSION['admin'];
		$this->query = "SELECT l.id, u.nombre, l.periodo_pago, l.remuneracion, l.descuento, l.neto 
						FROM liquidacion l JOIN
							usuario u ON l.id_usuario = u.id
						WHERE u.nombre = '$nombre'";
						//ORDER BY periodo"; //	
					 
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $liquidacion = new Liquidacion($fila['id'],$fila['nombre'],$fila['periodo_pago'],$fila['remuneracion'],
			 				  $fila['descuento'],$fila['neto']);
			 $matriz[$contador] = $liquidacion;
			 $contador++;
		}
		return $matriz;
	}

	public function gananciasDeLaApp(){
		$this->query = "SELECT id, fecha, monto
						FROM ganancia";	 
		$tabla = $this->get_query();
		return $tabla;
	}
}

//INSERT INTO `liquidacion` (`id`, `periodo_pago`, `remuneracion`, `descuento`, `neto`, `id_usuario`) 
//VALUES (NULL, '2018-12-05', '20000', '2000', '18000', '7');