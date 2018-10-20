<?php

class ViewController{
	private static $view_path = './views/';
	private $pagina; // indica si estoy en la vista de usuario normal o administrador

	public function __construct($pagina){
		$this->pagina = $pagina;
	}

	public function load_view($view){
		require_once(self::$view_path . $this->pagina . '/overall/head.php');
		require_once(self::$view_path . $this->pagina . '.php');
		require_once(self::$view_path . $this->pagina .'/overall/footer.php');
	}
}