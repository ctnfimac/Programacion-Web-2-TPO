<?php

require_once('class/Menu.php');

class MenuModel extends Conexion{

	public function mostrarMenus(){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT * FROM menu";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen']);
			 $matriz[$contador] = $menu;
			 $contador++;
		}
		return $matriz;
	}

	public function alta(){

	}
	public function baja($id){
		$this->query = "SELECT imagen FROM menu WHERE id = '$id'";
		$resultado = $this->get_query();
		$registro = $resultado->fetch_assoc();
		$url = $registro['imagen'];
		$this->query = "DELETE FROM menu WHERE id='$id'";
		$this->set_query();
		unlink($url);
	}
	public function modificacion(){

	}
}