<?php

require_once('class/Repartidor.php');

class RepartidorModel extends Conexion{
	
	private $operacion;

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
			case 'tomar_pedido':
				$this->tomar_pedido();
				break;
			case 'cancelar_pedido':
				$this->cancelar_pedido();
				break;
			case 'finalizar_pedido':
				$this->finalizar_pedido();
				break;
			default :
			    //echo 'no hago nada';
				break;
		}
		return $resultado;
	}
	protected function alta(){
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email  = $_POST['email'];
		$contrasenia = $_POST['contrasenia'];
		$telefono = $_POST['telefono'];
		//$fecha_nacimiento = $_POST['fecha_nacimiento'];
		$dni = $_POST['dni'];
		$cuil  = '20' . $dni . '1'; //20 masculino, 27 femenino
		if(!$this->verificaContrasenias()){
			echo 'error en las contraseñas';
		}else{
			if(!$this->existeUsuario($email)){
				$contrasenia = $_POST['pass'];
				$this->query = "INSERT INTO usuario(nombre,apellido,email,contrasenia,telefono)
								VALUES ('$nombre','$apellido','$email','$contrasenia','$telefono')";
				$this->set_query();

				$this->query = "SELECT id FROM usuario WHERE email = '$email'";
				$id_usuario = $this->buscarId();

				$this->query = "INSERT INTO repartidor(id_usuario,dni,cuil) 
								VALUES ('$id_usuario','$dni','$cuil')";
				$this->set_query();
			}		
		}	
	}

	protected function baja(){
		$id = $_GET['id'];
		$this->query = "DELETE FROM repartidor WHERE id_usuario='$id'";
		$this->set_query();
		$this->query = "DELETE FROM usuario WHERE id='$id'";
		$this->set_query();
		header('location:index.php?route=admin&tabla=repartidores');
	}

	protected function modificacion(){
		$id = $_POST['id'];
		$nombre = (isset($_POST['nombre']) && $_POST['nombre'] != "") ? $_POST['nombre'] : $_POST['nombreActual'];
		$apellido  = (isset($_POST['apellido']) && $_POST['apellido'] != "") ? $_POST['apellido'] : $_POST['apellidoActual'];
		$email = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : $_POST['emailActual'];
		$telefono = (isset($_POST['telefono']) && $_POST['telefono'] != "") ? $_POST['telefono'] : $_POST['telefonoActual'];
		$dni = (isset($_POST['dni']) && $_POST['dni'] != "") ? $_POST['dni'] : $_POST['dniActual'];
		$cuil = (isset($_POST['cuil']) && $_POST['cuil'] != "") ? $_POST['cuil'] : $_POST['cuilActual'];
		$fecha_nacimiento = (isset($_POST['fecha_nacimiento']) && $_POST['fecha_nacimiento'] != "") ? $_POST['fecha_nacimiento'] : $_POST['nacimientoActual'];


		$this->query = " UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', email = '$email', 
						 telefono = '$telefono' WHERE id = '$id' ";
		$this->set_query();	
		$this->query = " UPDATE repartidor SET dni = '$dni', cuil = '$cuil', 
						 fecha_nacimiento = '$fecha_nacimiento' 
						 WHERE id_usuario = '$id' ";
		$this->set_query();
		header('location:index.php?route=admin&tabla=repartidores');
	}

	private function verificaContrasenias(){
		return ($_POST['pass'] == $_POST['pass2'] && $_POST['pass'] != '' && $_POST['pass2'] != '' ) ? true : false ;
	}

	private function buscarId(){
		$id = '';
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$id = $row['id'];
		}
		return $id;
	}

	private function existeUsuario($email){
		$resultado = false;
		$this->query = "SELECT * FROM usuario WHERE email = '$email'";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$resultado = true;
		}
		return $resultado;
	}

	public function mostrarRepartidores(){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT  u.id, u.nombre, u.apellido, u.email, u.contrasenia, u.telefono, u.habilitado,
								r.fecha_nacimiento, r.dni, r.cuil , r.estado
						FROM usuario u JOIN 
							 repartidor r ON r.id_usuario = u.id";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $repartidor = new Repartidor($fila['id'],$fila['nombre'],$fila['apellido'],$fila['email'],$fila['contrasenia'],$fila['telefono'],
									$fila['fecha_nacimiento'],$fila['dni'], $fila['cuil'],$fila['habilitado'], $fila['estado']);
			 $matriz[$contador] = $repartidor;
			 $contador++;
		}
		return $matriz;
	}

	public function habilitar($habilitar){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			if($habilitar == 1) $this->query = "UPDATE usuario SET habilitado = 1 WHERE id='$id'";
			else $this->query = "UPDATE usuario SET habilitado = 0 WHERE id='$id'";
			$this->set_query();
			header('location:index.php?route=admin&tabla=repartidores');
		}
	}	

	public function getEstado(){
		$nombre = $_SESSION['admin'];
		$this->query = "SELECT r.estado 
						FROM repartidor r JOIN
							 usuario u ON u.id = r.id_usuario
						WHERE u.nombre ='$nombre'";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			$habilitado = $fila['estado'];
		}
		return $habilitado;
	}

	public function activar(){
		$nombre = $_SESSION['admin'];
		$this->query = "UPDATE repartidor SET estado = 1 
						WHERE id_usuario = (
							SELECT u.id FROM usuario u
							WHERE u.nombre = '$nombre'
						)";
		$this->set_query();
	}

	public function desactivar(){
		$nombre = $_SESSION['admin'];
		$this->query = "UPDATE repartidor SET estado = 0 
						WHERE id_usuario = (
							SELECT u.id FROM usuario u
							WHERE u.nombre = '$nombre'
						)";
		$this->set_query();
	}


	private function tomar_pedido(){
		//cambio el estado 
		///echo 'estoy en tomar pedido';
		require_once('PedidoModel.php');
		$pedido = new PedidoModel();
		//echo $_SESSION['admin'];
		$pedido->estadoPedidoTomar($_GET['id_pedido']);
		header('location:index.php?route=admin&tabla=pedidos_realizados');
	}

	private function cancelar_pedido(){
		//cambio el estado 
		///echo 'estoy en tomar pedido';
		require_once('PedidoModel.php');
		$pedido = new PedidoModel();
		$pedido->estadoPedidoCancelar($_GET['id_pedido']);
		header('location:index.php?route=admin&tabla=pedidos_realizados');
	}

	private function finalizar_pedido(){
		//cambio el estado 
		///echo 'estoy en tomar pedido';
		require_once('PedidoModel.php');
		$pedido = new PedidoModel();
		$pedido->estadoPedidoFinalizar($_GET['id_pedido']);
		header('location:index.php?route=admin&tabla=pedidos_realizados');
	}

	public function obtenerNombreDelRepartidor($id_repartidor){
		$resultado = false;
		$this->query = "SELECT nombre FROM usuario WHERE id = '$id_repartidor' LIMIT 1";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$resultado = $row['nombre'];
		}
		return $resultado;
	}
}