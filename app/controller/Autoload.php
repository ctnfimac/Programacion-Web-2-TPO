<?php

class Autoload{
	public function __construct(){
		// Registrar las funciones dadas como implementación de __autoload()
		// En este caso recibe una funcion anonima
		spl_autoload_register(function($class_name){
			$model_path = './model/' . $class_name . '.php';
			$controller_path = './controller/' .$class_name . '.php';

			if(file_exists($model_path)) require_once($model_path);
			if(file_exists($controller_path)) require_once($controller_path);
		});
	}
}