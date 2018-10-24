<?php

class AdminModel extends Conexion{

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
		}
		return $admin_nombre;
	}

	public function alta(){
		
	}
	public function baja(){

	}
	public function modificacion(){

	}
}