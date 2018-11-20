<?php

require_once('class/Comercio.php');

class ComercioModel extends Conexion{
	
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
		$cuit = $_POST['cuit'];
		if(!$this->verificaContrasenias()){
			echo 'error en las contraseñas';
		}else{
			if(!$this->existeUsuario($email)){
				$contrasenia = password_hash($_POST['pass'], PASSWORD_BCRYPT);
				$this->query = "INSERT INTO usuario(nombre,apellido,email,contrasenia,telefono)
								VALUES ('$nombre','$apellido','$email','$contrasenia','$telefono')";
				$this->set_query();

				$this->query = "SELECT id FROM usuario WHERE email = '$email'";
				$id_usuario = $this->buscarId();

				$this->query = "INSERT INTO comercio(id_comercio,cuit) 
								VALUES ('$id_usuario','$cuit')";
				$this->set_query();
			}		
		}	
	}

	protected function baja(){
		$id = $_GET['id'];
		$this->query = "DELETE FROM comercio WHERE id_comercio='$id'";
		$this->set_query();
		$this->query = "DELETE FROM usuario WHERE id='$id'";
		$this->set_query();
		header('location:index.php?route=admin&tabla=comercios');
	}

	protected function modificacion(){
		$id = $_POST['id'];
		$nombre = (isset($_POST['nombre']) && $_POST['nombre'] != "") ? $_POST['nombre'] : $_POST['nombreActual'];
		$apellido  = (isset($_POST['apellido']) && $_POST['apellido'] != "") ? $_POST['apellido'] : $_POST['apellidoActual'];
		$email = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : $_POST['emailActual'];
		$telefono = (isset($_POST['telefono']) && $_POST['telefono'] != "") ? $_POST['telefono'] : $_POST['telefonoActual'];
		$cuit = (isset($_POST['cuit']) && $_POST['cuit'] != "") ? $_POST['cuit'] : $_POST['cuitActual'];


		$this->query = " UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', email = '$email', 
						 telefono = '$telefono' WHERE id = '$id' ";
		$this->set_query();	
		$this->query = " UPDATE comercio SET  cuit = '$cuit'
						 WHERE id_comercio = '$id' ";
		$this->set_query();
		header('location:index.php?route=admin&tabla=comercios');
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

	public function mostrarComercios(){
		$matriz = array();
		$contador = 0;
		$this->query = "SELECT  u.id, u.nombre, u.apellido, u.email, u.contrasenia, u.telefono, u.habilitado,
								c.cuit
						FROM usuario u JOIN 
							 comercio c ON c.id_comercio = u.id";
		$tabla = $this->get_query();
		while($fila = $tabla->fetch_assoc()){
			 $comercio = new Comercio($fila['id'],$fila['nombre'],$fila['apellido'],$fila['email'],$fila['contrasenia'],$fila['telefono'],
									 $fila['cuit'],$fila['habilitado']);
			 $matriz[$contador] = $comercio;
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
			header('location:index.php?route=admin&tabla=comercios');
		}
	}	

	public function obtenerNombreDelComercio($id_comercio){
		$resultado = false;
		$this->query = "SELECT nombre FROM usuario WHERE id = '$id_comercio' LIMIT 1";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$resultado = $row['nombre'];
		}
		return $resultado;
	}
	
}