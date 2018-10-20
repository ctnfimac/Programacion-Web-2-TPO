<?php

class Router{

	public function __construct($route){

		$view_controller = new ViewController($route);

		switch($route){
			case 'home':
				$view_controller->load_view('home');
				 break;
			default:
				echo 'error 404, pagina no encontrada';
				break; 
		}
	}
}