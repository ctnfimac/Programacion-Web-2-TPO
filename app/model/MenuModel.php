<?php

require_once('class/Menu.php');

class MenuModel extends Conexion{

	const URL = './public/img/menu/';

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
		$descripcion = $_POST['descripcion'];
		$url_img =  self::URL . $_FILES['fileImagen']['name'];

		// guardo la imagen en el directorio
		if(file_exists($url_img)) unlink($url_img);
			move_uploaded_file($_FILES["fileImagen"]["tmp_name"], $url_img);

		$this->query = "INSERT INTO menu (descripcion,imagen) VALUES ('$descripcion','$url_img')";
		$this->set_query();
	}


	public function baja($id){
		$this->query = "SELECT imagen FROM menu WHERE id = '$id'";
		$resultado = $this->get_query();
		$registro = $resultado->fetch_assoc();
		$url = $registro['imagen'];
		$this->query = "DELETE FROM menu WHERE id='$id'";
		$this->set_query();
		if(file_exists($url)) unlink($url);
		//	unlink($url);
	}

	public function modificacion(){
		$id = $_POST['id'];
		$descripcion = (isset($_POST['descripcion']) && $_POST['descripcion'] != "") ? $_POST['descripcion'] : $_POST['descripcionActual'];
		$imagen = (isset($_FILES['fileImagen']) && $_FILES['fileImagen']['tmp_name'] != "") ? self::URL . $_FILES['fileImagen']['name'] : $_POST['fileImagenActual'];

		if($_FILES['fileImagen']['tmp_name'] != ""){
			unlink($_POST['fileImagenActual']);
			if(file_exists($imagen)) unlink($imagen);
			 move_uploaded_file($_FILES["fileImagen"]["tmp_name"], $imagen);
		  }

		$this->query = " UPDATE menu SET descripcion = '$descripcion', imagen = '$imagen' WHERE id = '$id' ";
		$this->set_query();	
	}
}