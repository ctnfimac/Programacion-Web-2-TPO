<?php

class ClienteModel extends Conexion{
	
	private $operacion;

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

	public function ejecutarOperacion(){
		$id = isset($_GET['id'])? $_GET['id'] : 'sin setear';
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

	protected function baja(){

	}
	protected function modificacion(){

	}

	private function verificaContrasenias(){
		return ($_POST['pass'] == $_POST['pass2']) ? true : false ;
	}

	private function buscarId(){
		$id = '';
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$id = $row['id'];
		}
		echo 'id buscado: ' . $id;
		return $id;
	}
}