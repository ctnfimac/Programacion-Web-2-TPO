<?php

class Router{

	public function __construct($route){

		switch($route){
			case 'home':
				include('views/home.php');
			 	break;
		}
	}
}