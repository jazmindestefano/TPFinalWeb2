<?php
		include_once("helpers/ValidarUsuarioLogeado.php");
    include_once('Configuration.php');

		session_start();

    $configuration = new Configuration();
    $router = $configuration->getRouter();

    $module = $_GET['module'] ?? 'labanda';
    $method = $_GET['action'] ?? 'list';

	if($module !== 'login' && $module !== 'register') {
		$validarUsuarioLogeado = new ValidarUsuarioLogeado();
		$validarUsuarioLogeado->validarUsuarioLogeado();
	}

    $router->route($module, $method);




