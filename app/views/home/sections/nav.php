<?php

$nav = '
<header>
          <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar ">
            <div class="container">
              <a class="navbar-brand" href="#"><strong>COMIDAS</strong></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Servicios</a>
				  </li>
				  %s
                </ul>
              </div>
            </div>
          </nav>
';

if(isset($_SESSION['admin'])){
	$nav_item = '
	<li class="nav-item dropdown no-arrow">
		<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			'.$_SESSION['admin'].'
		</a>
		<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
			<a class="dropdown-item text-center" href="index.php?route=salir">Cerrar Sesión</a>
		</div>
	</li>';
}else {
	$nav_item = '
	<li class="nav-item">
		<a class="nav-link" href="#">Login</a>
	</li>
	';
}