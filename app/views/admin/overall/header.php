<?php
//session_start();
$cabecera = '
<nav class="navbar navbar-expand navbar-dark bg-dark static-top d-flex justify-content-between">
	<a class="navbar-brand mr-1" href="index.html">Administración</a>  
	<!-- Navbar -->
	<ul class="navbar-nav ml-auto ml-md-0">
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user-circle fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="#">%s</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="index.php">Home</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="index.php?route=salir">Cerrar Sesión</a>
			</div>
		</li>
	</ul>
</nav>

  <div id="wrapper">
	<!-- Sidebar -->
	<ul class="sidebar navbar-nav">
	  <li class="nav-item active">
		<a class="nav-link" href="index.html">
		  <i class="fas fa-fw fa-tachometer-alt"></i>
		  <span>Dashboard</span>
		</a>
	  </li>

	  <li class="nav-item">
		<a class="nav-link" href="charts.html">
		  <i class="fas fa-fw fa-chart-area"></i>
		  <span>Charts</span></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="tables.html">
		  <i class="fas fa-fw fa-table"></i>
		  <span>Tables</span></a>
	  </li>
	</ul>

	<div id="content-wrapper">
	  <div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
		  <li class="breadcrumb-item">
			<a href="#">Dashboard</a>
		  </li>
		  <li class="breadcrumb-item active">Overview</li>
		</ol>
';



printf($cabecera,$_SESSION['admin']);