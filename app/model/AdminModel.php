<?php

class AdminModel extends Conexion{
	private $seccion = 'home';

	public function buscarUsuario($email,$pass){
		//$matriz = array();
		$admin_nombre = false;
		$this->query = 
				"SELECT * 
				 FROM usuario
				 WHERE email = '$email' AND contrasenia = '$pass' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			$admin_nombre = $fila['nombre'];
			$this->setSeccion($fila['id']);
		}
		return $admin_nombre;
	}

	public function getSeccion(){
		return $this->seccion;
	}

	private function setSeccion($id){
		// $clienteModel = new ClienteModel();
		// $clienteModel->query = "SELECT * FROM cliente WHERE id_usuario = '$id'";
		// if($clienteModel->get_query() != null) {
		// 	$this->seccion = 'cliente';
		// 	return;
		// }

		$this->seccion = 'admin';	
		$_SESSION['usuario'] = 'admin';

		$comercioModel = new ComercioModel();
		$comercioModel->query = "SELECT * FROM comercio WHERE id_comercio = '$id'";
		$tabla = $comercioModel->get_query() ;
		//echo 'antes';
		while($fila = $tabla->fetch_assoc()) {
			$this->seccion = 'comercio';
			$_SESSION['usuario'] = 'comercio';
		}

		// $RepartidorModel = new RepartidorModel();
		// $RepartidorModel->query = "SELECT * FROM repartidor WHERE id_usuario = '$id'";
		// if($RepartidorModel->get_query() != null) $this->seccion = 'repartidor';
	}

	public function alta(){
		
	}
	public function baja(){

	}
	public function modificacion(){

	}
}