<?php

abstract class Conexion{
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '';
	private static $db_name = 'pw';
	private static $db_charset = 'utf8';
	private $conn;
	protected $query;
	protected $rows = array();

	abstract protected function alta();
	abstract protected function baja();
	abstract protected function modificacion();

	private function db_open(){
		$this->conn = new mysqli(
			self::$db_host,
			self::$db_user,
			self::$db_pass,
			self::$db_name
		);
		$this->conn->set_charset(self::$db_charset);
	}

	private function db_close(){
		$this->conn->close();
	}

	protected function set_query(){
		$this->db_open();
		$this->conn->query($this->query);
		$this->db_close();
	}

	protected function get_query(){
		$this->db_open();
		$resultado = $this->conn->query($this->query);
		$this->db_close();
		return $resultado;	
	}
}