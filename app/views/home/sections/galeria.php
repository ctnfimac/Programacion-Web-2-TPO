<?php

// imagenes de 600x451

$articulos = '';
foreach($lista_de_menus as $menu){
	$articulos .= '
		<div class="card p-1 m-1">
			<img class="card-img-top" src="'.$menu->getImagen().'" alt="'.$menu->getDescripcion().'">
			<div class="card-body">
				<p class="card-title" style="font-size:1.2em">'.$menu->getDescripcion().'</p>
				<p class="card-text mb-3">menu '.$menu->getId().'</p>
				<div class="w-100 d-flex justify-content-center align-items-center">
					<span class="float-right block-example border text-2 mr-2">$250</span>
					<a href="#" class="fa fa-shopping-cart float-right block-example text-2 pl-2" style="font-size:1.6em;"></a>
				</div>
			</div>
		</div>
	';
}

$galeria = '
<section id="galeria" class="galeria mt-5 mb-5">
	<h2 class="text-center">Menus</h2>
	<p class="text-center">Mire alguno de nuestros diferentes deliciosos menus</p>
	<div class="container-fluid">
		<div class="row d-flex flex-fill justify-content-center">
			%s
		</div>
	</div>
</section> 
';