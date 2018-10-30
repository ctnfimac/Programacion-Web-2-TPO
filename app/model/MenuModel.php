<?php

require_once('class/Menu.php');

class MenuModel extends Conexion{

	const URL = './public/img/menu/';
	private $operacion;

	public function mostrarMenus(){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT * FROM menu";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio']);
			 $matriz[$contador] = $menu;
			 $contador++;
		}
		return $matriz;
	}

	public function mostrarRecomendaciones(){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT * FROM menu LIMIT 3";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio']);
			 $matriz[$contador] = $menu;
			 $contador++;
		}
		return $matriz;
	}

	protected function alta(){
		$descripcion = $_POST['descripcion'];
		$precio = $_POST['precio'];
		$url_img =  self::URL . $_FILES['fileImagen']['name'];

		// guardo la imagen en el directorio
		if(file_exists($url_img)) unlink($url_img);
			move_uploaded_file($_FILES["fileImagen"]["tmp_name"], $url_img);

		$this->query = "INSERT INTO menu (descripcion,imagen,precio) VALUES ('$descripcion','$url_img','$precio')";
		$this->set_query();
	}


	protected function baja(){
		$id = $_GET['id'];
		$this->query = "SELECT imagen FROM menu WHERE id = '$id'";
		$resultado = $this->get_query();
		$registro = $resultado->fetch_assoc();
		$url = $registro['imagen'];
		$this->query = "DELETE FROM menu WHERE id='$id'";
		$this->set_query();
		if(file_exists($url)) unlink($url);
		//	unlink($url);
	}

	protected function modificacion(){
		$id = $_POST['id'];
		$descripcion = (isset($_POST['descripcion']) && $_POST['descripcion'] != "") ? $_POST['descripcion'] : $_POST['descripcionActual'];
		$imagen = (isset($_FILES['fileImagen']) && $_FILES['fileImagen']['tmp_name'] != "") ? self::URL . $_FILES['fileImagen']['name'] : $_POST['fileImagenActual'];
		$precio = (isset($_POST['precio']) && $_POST['precio'] != "") ? $_POST['precio'] : $_POST['precioActual'];

		if($_FILES['fileImagen']['tmp_name'] != ""){
			unlink($_POST['fileImagenActual']);
			if(file_exists($imagen)) unlink($imagen);
			 move_uploaded_file($_FILES["fileImagen"]["tmp_name"], $imagen);
		  }

		$this->query = " UPDATE menu SET descripcion = '$descripcion', imagen = '$imagen', precio = '$precio' WHERE id = '$id' ";
		$this->set_query();	
	}

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	public function ejecutoOperacion(){
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

	public function precioPorId($id){
		$this->query = "SELECT precio FROM menu WHERE id='$id' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $precio = $fila['precio'];
		}
		// return $matriz;
		return $precio;
	}

	public function menuPorId($id){
		$tabla = array();
		$this->query = "SELECT * FROM menu WHERE id='$id' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio']);
		}
		// return $matriz;
		return $menu;
	}
}