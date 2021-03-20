
<header class="main-header" >
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo" >
		
		<!-- logo mini -->
		<span class="logo-mini">
			
			<img src="vista/img/plantilla/logo_geriatry.png" class="img-responsive" style="padding:0px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">
			
			<img src="vista/img/plantilla/logo_login_geriatry_blanco.png" class="img-responsive" style="height:58px;">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top"  role="navigation" >
		
		<!-- Botón de navegación / boton de ocultar panel -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> 
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<?php

						if($_SESSION["foto"] != ""){

							echo '<img src="'. $_SESSION["foto"].'"  class="user-image">';


						}else{

							echo '<img src="vista/img/usuarios/default/anonymous.png" class="user-image">';
						}
					?>
						
						
						<span class="hidden-xs"><?php echo $_SESSION["nombre"] ?> / <?php echo $_SESSION["perfil"] ?></span>

						


					</a>

					<!-- Dropdown-toggle -->
						<!-- #f9fafc se ha sustituido en todo por este color: rgba(60, 141, 188, 0.9) -->
					<ul class="dropdown-menu" style="background:rgba(60, 141, 188, 0.1); margin-top:2px; width:100%; height:100%">
						
						<li class="user-body">
							
							<div class="pull-right">
								
								<a style="margin:-5px 0 0px 0" href="salir" class="btn btn-default">Salir</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>