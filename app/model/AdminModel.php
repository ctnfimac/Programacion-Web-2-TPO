<?php

class AdminModel extends Conexion{
	public function buscarAdministrador($email,$pass){
		//$matriz = array();
		$admin_email = false;
		$this->query = 
				"SELECT * 
				 FROM admin 
				 WHERE email = '$email' AND pass = '$pass' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			$admin_email = $fila['email'];
		}
		return $admin_email;
	}

	public function alta(){

	}
	public function baja(){

	}
	public function modificacion(){

	}
}