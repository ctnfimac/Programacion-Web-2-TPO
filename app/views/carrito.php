<?php

require_once('carrito/sections/nav.php');
require_once('carrito/sections/banner.php');
require_once('carrito/sections/carrito_tabla.php');
require_once('carrito/sections/galeria.php');
require_once('carrito/sections/contacto.php');
require_once('carrito/sections/modal_registro.php');

printf($nav,$nav_item);
printf($banner);
printf($carrito_tabla,$items_carrito);
printf($galeria,$articulos);
printf($contacto);
printf($modal_registro);