<?php

class OfertaModel extends Conexion{
	public function buscarMenuDelDia(){
		$id_menu = '';
		$menu = array();
		$this->query = "SELECT * 
						FROM Menu 
						WHERE id = (SELECT id_menu FROM oferta WHERE CURDATE() = fecha LIMIT 1) 
						LIMIT 1";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$menu = new Menu($row['id'],$row['descripcion'],$row['imagen'],$row['precio'],$row['id_comercio']);
		}
		return $menu;
	}

	public function alta(){}
	public function baja(){}
	public function modificacion(){}
}