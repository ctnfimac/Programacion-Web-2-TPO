<?php

require_once('class/Menu.php');

class MenuModel extends Conexion{

	const URL = './public/img/menu/';
	private $operacion;

	public function mostrarMenus(){
		$matriz = array();
		$contador = 0;
		// $this->query = "SELECT * FROM menu";
		$this->query = "SELECT m.id, m.descripcion, m.imagen, m.precio, u.nombre as comercio
						FROM menu m JOIN
							 comercio c ON c.id_comercio = m.id_comercio JOIN
							 usuario u ON u.id = c.id_comercio ";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio'],$fila['comercio']);
			 $matriz[$contador] = $menu;
			 $contador++;
		}
		return $matriz;
	}

	public function mostrarMenusDeUnComercio(){
		$comercio = isset($_SESSION['admin']) ?  $_SESSION['admin'] : '';
		$matriz = array();
		$contador = 0;
		// $this->query = "SELECT * FROM menu";
		$this->query = "SELECT m.id, m.descripcion, m.imagen, m.precio, u.nombre as comercio
						FROM menu m JOIN
							 comercio c ON c.id_comercio = m.id_comercio JOIN
							 usuario u ON u.id = c.id_comercio ";
		if($comercio != '') $this->query .= " WHERE u.nombre = '$comercio'";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio'],$fila['comercio']);
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
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio'],$fila['id_comercio']);
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

		$comercio = $_SESSION['admin'];
		$this->query = "INSERT INTO menu (descripcion,imagen,precio,id_comercio) VALUES ('$descripcion','$url_img','$precio',
											(SELECT u.id 
											 FROM usuario u
											 WHERE u.nombre = '$comercio'))";
		$this->set_query();

		$route = $_GET['route'];
		header('location:index.php?route='.$route.'&tabla=menus');
	}


	protected function baja(){
		$id = $_GET['id'];
		$this->query = "SELECT imagen FROM menu WHERE id = '$id'";
		$resultado = $this->get_query();
		$registro = $resultado->fetch_assoc();
		$url = $registro['imagen'];

		// primero elimino la oferta si es que existe
		$this->query = "DELETE FROM oferta WHERE id_menu='$id'";
		$this->set_query();

		$this->query = "DELETE FROM menu WHERE id='$id'";
		$this->set_query();
		if(file_exists($url)) unlink($url);

		$route = $_GET['route'];
		header('location:index.php?route='.$route.'&tabla=menus');
	}

	protected function modificacion(){
		$id = $_POST['id'];
		$descripcion = (isset($_POST['descripcion']) && $_POST['descripcion'] != "") ? $_POST['descripcion'] : $_POST['descripcionActual'];
		$imagen = (isset($_FILES['fileImagen']) && $_FILES['fileImagen']['tmp_name'] != "") ? self::URL . $_FILES['fileImagen']['name'] : $_POST['fileImagenActual'];
		$precio = (isset($_POST['precio']) && $_POST['precio'] != "") ? $_POST['precio'] : $_POST['precioActual'];

		if($_FILES['fileImagen']['tmp_name'] != ""){
			if(file_exists($_POST['fileImagenActual'])) unlink($_POST['fileImagenActual']);
			if(file_exists($imagen)) unlink($imagen);
			 move_uploaded_file($_FILES["fileImagen"]["tmp_name"], $imagen);
		  }

		$this->query = " UPDATE menu SET descripcion = '$descripcion', imagen = '$imagen', precio = '$precio' WHERE id = '$id' ";
		$this->set_query();	
		//header('location:index.php?route=admin&tabla=menus');
		$route = $_GET['route'];
		//echo 'ruta: ' . $route;
		header('location:index.php?route='.$route.'&tabla=menus');
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

	public function precioPorId($id){
		$this->query = "SELECT precio FROM menu WHERE id='$id' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $precio = $fila['precio'];
		}
		return $precio;
	}

	public function menuPorId($id){
		$tabla = array();
		$this->query = "SELECT * FROM menu WHERE id='$id' LIMIT 1";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $menu = new Menu($fila['id'],$fila['descripcion'],$fila['imagen'],$fila['precio'],$fila['id_comercio']);
		}
		return $menu;
	}
}