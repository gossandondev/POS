<header class="main-header">
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="" class="logo">
		<!-- Logo mini -->
		<span class="logo-mini">
			<img src="Views/img/template/icono-blanco.png" class="img-responsive" style="padding:10px">
		</span>
		
		<!-- Logo Normal -->
		<span class="logo-lg">
			<img src="Views/img/template/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">
		</span>
	</a>

	<!--=====================================
	BARRA DE NAVEGACION
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Boton de navegacion -->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle Navigation</span>
		</a>

		<!-- Perfil de usuario -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php
							if ($_SESSION["Photo"] != "") {
								echo '<img src="'.$_SESSION["Photo"].'" class="user-image">';
							}else{
								echo '<img src="Views/img/user/default/anonymous.png" class="user-image">';
							}
						?>
						<span class="hidden-xs"><?php echo $_SESSION["Name"]; ?></span>
					</a>
					<!-- Dropdown-toggle --> 
					<ul class="dropdown-menu">
						<li class="user-body">
							<div class="pull-right">
								<a href="logout" class="btn btn-default btn-flat">Salir</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>

		
	</nav>
</header>