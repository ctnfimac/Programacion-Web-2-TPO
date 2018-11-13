<?php

require_once('class/Cliente.php');

class ClienteModel extends Conexion{
	
	private $operacion;

	public function setOperacion($operacion){
		$this->operacion = $operacion;
	}

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
		$calle  = $_POST['calle'];
		$numero = $_POST['numero'];
		$telefono = $_POST['telefono'];
		$localidad = $_POST['localidad'];
		if(!$this->verificaContrasenias()){
			echo 'error en las contraseñas';
		}else{
			if(!$this->existeUsuario($email)){
				$contrasenia = $_POST['pass'];
				$this->query = "INSERT INTO usuario(nombre,apellido,email,contrasenia,telefono,habilitado)
								VALUES ('$nombre','$apellido','$email','$contrasenia','$telefono',1)";
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
		$this->query = "DELETE FROM cliente WHERE id_usuario='$id'";
		$this->set_query();
		$this->query = "DELETE FROM usuario WHERE id='$id'";
		$this->set_query();
		header('location:index.php?route=admin&tabla=clientes');
	}

	protected function modificacion(){
		$id = $_POST['id'];
		$nombre = (isset($_POST['nombre']) && $_POST['nombre'] != "") ? $_POST['nombre'] : $_POST['nombreActual'];
		$apellido  = (isset($_POST['apellido']) && $_POST['apellido'] != "") ? $_POST['apellido'] : $_POST['apellidoActual'];
		$email = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : $_POST['emailActual'];
		$telefono = (isset($_POST['telefono']) && $_POST['telefono'] != "") ? $_POST['telefono'] : $_POST['telefonoActual'];
		$calle = (isset($_POST['calle']) && $_POST['calle'] != "") ? $_POST['calle'] : $_POST['calleActual'];
		$numero = (isset($_POST['numero']) && $_POST['numero'] != "") ? $_POST['numero'] : $_POST['numeroActual'];
		$localidad = (isset($_POST['localidad']) && $_POST['localidad'] != "") ? $_POST['localidad'] : $_POST['localidadActual'];


		$this->query = " UPDATE usuario SET nombre = '$nombre', apellido = '$apellido', email = '$email', 
						 telefono = '$telefono' WHERE id = '$id' ";
		$this->set_query();	
		$this->query = " UPDATE cliente SET calle = '$calle', numero = '$numero', 
						 id_localidad = (SELECT id FROM localidad where descripcion = '$localidad') 
						 WHERE id_usuario = '$id' ";
		$this->set_query();
		header('location:index.php?route=admin&tabla=clientes');
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

	
	public function habilitar($habilitar){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			if($habilitar == 1) $this->query = "UPDATE usuario SET habilitado = 1 WHERE id='$id'";
			else $this->query = "UPDATE usuario SET habilitado = 0 WHERE id='$id'";
			$this->set_query();
			header('location:index.php?route=admin&tabla=clientes');
		}
	}
	
	public function buscarIdPorNombre($nombre){
		$this->query = "SELECT id FROM Usuario WHERE nombre = '$nombre' LIMIT 1";
		$tabla = $this->get_query();
		$id = '';
		while($fila = $tabla->fetch_assoc()){
			$id = $fila['id'];
		}
		return $id;
	}

	public function obtenerNombreDelCliente($id_cliente){
		$resultado = false;
		$this->query = "SELECT nombre FROM usuario WHERE id = '$id_cliente' LIMIT 1";
		$tabla = $this->get_query();
		while($row = $tabla->fetch_assoc()){
			$resultado = $row['nombre'];
		}
		return $resultado;
	}
	
}