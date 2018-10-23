<?php
    $result = '';
	//if(isset($_COOKIE['session']) || isset($_SESSION['admin'])){
	if(isset($_SESSION['admin'])){
	$result .= '<a href="index.php?route=admin"  class="btn btn-info btn-block my-4" >Entrar</a>';
	}else{
		$result .='<button class="btn btn-info btn-block my-4" type="submit">Entrar</button>'; 
	}

$banner = '
		<div class="view" style="background-image: url(\'public/img/home/banner01.jpg\'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
            <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
              <div class="container">
                <div class="row d-flex justify-content-center align-items-center">
                  <!-- <div class="col-md-12 mb-4  col-md-4 white-text text-center"> -->
					<div class="col-xs-12 col-sm-6 mb-4 col-lg-8 white-text text-center">
                    <h1 class="h1-reponsive white-text text-uppercase font-weight-bold mb-0  pt-5 wow fadeInDown" data-wow-delay="0.3s"><strong>Elija el menu de su comida</strong></h1>
                    <hr class="hr-light my-4 wow fadeInDown" data-wow-delay="0.4s">
                    <h5 class="text-uppercase mb-4 white-text wow fadeInDown" data-wow-delay="0.4s"><strong>Cenas & Almuerzos</strong></h5>
                    <a class="btn border border-light  black wow fadeInDown" data-wow-delay="0.4s">Menus</a>
                    <a class="btn border border-light  black wow fadeInDown" data-wow-delay="0.4s">Servicios</a>
				  </div> 
				  
				  <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
						<form class="text-center border border-light p-3 bg-white rounded mb-0" action="index.php?route=admin" method="POST">
							<p class="h4 mb-4">Login</p>
							<input type="text" id="defaultLoginFormEmail" name="email" class="form-control mb-4" placeholder="E-mail" required>
							<input type="password" id="defaultLoginFormPassword" name="password" class="form-control mb-4" placeholder="Password" required>
							<div class="d-flex justify-content-around">
								<div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" name="recordarme" id="recordarme" class="custom-control-input">
										<label class="custom-control-label" for="recordarme">Recordarme</label>
									</div>
								</div>
								<div>
									<a href="">Perdió su contraseña</a>
								</div>
							</div>
							%s
							<!--<button class="btn btn-info btn-block my-4" type="submit">Entrar</button>-->
							<p>¿No eres miembro aún?
								<a href="" data-toggle="modal" data-target="#modalLRFormDemo" >Registrarse</a>
							</p>
						</form>
				  </div>

                </div>          
              </div>   
            </div>   
          </div>
</header>
';

