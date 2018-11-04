<?php

require_once('./controller/Autoload.php');
$autoload = new Autoload();

$route = isset($_GET['route']) ? $_GET['route'] : 'home';
//echo 'route primary: ' . $route . '<br>';
$app = new Router($route);
