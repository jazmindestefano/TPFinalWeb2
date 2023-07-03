<?php
include_once("helpers/ValidarUsuarioLogeado.php");
include_once('Configuration.php');

session_start();

$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'list';

if ($module !== 'login' && $module !== 'register') {
    $validarUsuarioLogeado = new ValidarUsuarioLogeado();
    $validarUsuarioLogeado->validarUsuarioLogeado();
}

if ($module === 'editor' && !$_SESSION['esEditor']) {
    header('Location: /');
    exit();
}

if ($module === 'admin' && !$_SESSION['esAdmin']) {
    header('Location: /');
    exit();
}

$router->route($module, $method);




