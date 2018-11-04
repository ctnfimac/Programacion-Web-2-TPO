<?php

require_once('class/Cliente.php');

class ClienteModel extends Conexion{
	
	private $operacion;

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	// public function ejecutoOperacion(){
	// 	$resultado = $this->operacion;
	// 	switch($resultado){
	// 		case 'agregar':
	// 			$this->alta();
	// 			$resultado = '';
	// 			break;
	// 		case 'eliminar':
	// 			$this->baja();
	// 			$resultado = '';
	// 			break;
	// 		case 'modificar':
	// 			$this->modificacion();
	// 			$resultado = '';
	// 			break;
	// 	}
	// 	return $resultado;//para que regrese al administrador
	// }

	public function ejecutarOperacion(){
		$id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
		$resultado = $this->operacion;
		switch($this->operacion){
			case 'agregar':
				$this->alta($id);
				$resultado = '';
				break;
			case 'eliminar':
				$this->baja($id);
				$resultado = '';
				break;
			case 'modificar':
				$this->modificar($id);
				$resultado = '';
				break;
			default :
			    //echo 'no hago nada';
				break;
		}
		return $resultado;
	}
	protected function alta(){
		echo 'estoy en alta de cliente';
		// agrego los datos del usuario
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email  = $_POST['email'];
		$calle  = $_POST['calle'];
		$numero = $_POST['numero'];
		$telefono = $_POST['telefono'];
		$localidad = $_POST['localidad'];
		if(!$this->verificaContrasenias()){
			echo 'error en las contraseñas';
		}else{
			if(!$this->existeUsuario($email)){
				$contrasenia = $_POST['pass'];
				$this->query = "INSERT INTO usuario(nombre,apellido,email,contrasenia,telefono)
								VALUES ('$nombre','$apellido','$email','$contrasenia','$telefono')";
				$this->set_query();

				$this->query = "SELECT id FROM localidad WHERE descripcion = '$localidad'";
				$id_localidad = $this->buscarId();

				$this->query = "SELECT id FROM usuario WHERE email = '$email'";
				$id_usuario = $this->buscarId();

				$this->query = "INSERT INTO cliente(calle,numero,id_localidad,id_usuario) 
								VALUES ('$calle','$numero','$id_localidad','$id_usuario')";
				$this->set_query();
			}		
		}	
	}

	protected function baja(){
		$id = $_GET['id'];
		// $this->query = "SELECT imagen FROM menu WHERE id = '$id'";
		// $resultado = $this->get_query();
		// $registro = $resultado->fetch_assoc();
		// $url = $registro['imagen'];
		$this->query = "DELETE FROM cliente WHERE id_usuario='$id'";
		$this->set_query();
		$this->query = "DELETE FROM usuario WHERE id='$id'";
		$this->set_query();

	}

	protected function modificacion(){

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
		//echo 'id buscado: ' . $id;
		return $id;
	}

	private function existeUsuario($email){
		$resultado = false;
		$this->query = "SELECT * FROM usuario WHERE email = '$email'";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$resultado = true;
		}
		//echo ($resultado == true) ? "existe" : "no existe";
		return $resultado;
	}

	public function mostrarClientes(){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT  u.id, u.nombre, u.apellido, u.email, u.contrasenia, u.telefono, u.habilitado,
								c.calle, c.numero, l.descripcion as localidad
						FROM cliente c JOIN 
							 usuario u ON u.id = c.id_usuario JOIN
							 localidad l ON l.id = c.id_localidad";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $cliente = new Cliente($fila['id'],$fila['nombre'],$fila['apellido'],$fila['email'],$fila['contrasenia'],$fila['telefono'],
									$fila['calle'],$fila['numero'], $fila['localidad'],$fila['habilitado']);
			 $matriz[$contador] = $cliente;
			 $contador++;
		}
		return $matriz;
	}

	
}