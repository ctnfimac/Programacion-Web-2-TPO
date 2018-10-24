<?php

require_once('home/sections/nav.php');
require_once('home/sections/banner.php');
require_once('home/sections/servicios.php');
require_once('home/sections/promocion.php');
require_once('home/sections/galeria.php');
require_once('home/sections/contacto.php');
require_once('home/sections/modal_registro.php');

// printf($nav,$_SESSION['admin']);

if(isset($_SESSION['admin'])){
	printf($nav,$_SESSION['admin']);
	printf($banner,'');
}else {
	printf($nav,'Login');
	printf($banner,$formulario);
}
printf($servicios);
printf($promocion);
printf($galeria);
printf($contacto);
printf($modal_registro);
