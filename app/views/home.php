<?php

// echo 'estas en el home';
// include('home/overall/head.php');

require_once('home/sections/nav.php');
require_once('home/sections/banner.php');
require_once('home/sections/servicios.php');
require_once('home/sections/promocion.php');
require_once('home/sections/galeria.php');
require_once('home/sections/contacto.php');
require_once('home/sections/modal_registro.php');

printf($nav);
printf($banner);
printf($servicios);
printf($promocion);
printf($galeria);
printf($contacto);
printf($modal_registro);

// include('home/overall/footer.php');