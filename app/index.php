<?php

require_once('./controller/Autoload.php');
$autoload = new Autoload();

$route = isset($_GET['route']) ? $_GET['route'] : 'home';

$app = new Router($route);
