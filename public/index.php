<?php
session_start();
include dirname(__DIR__) . '/vendor/autoload.php'; // автозагрузчик от twig

$controller = 'user';
if(!empty($_GET['c'])){
    $controller = trim($_GET['c']);
}
$action = '';
if(!empty($_GET['a'])){
    $action = trim($_GET['a']);
}

$controllerName = 'App\\controllers\\' . ucfirst($controller) . 'Controller';
if (!class_exists($controllerName)){
    echo "404_c";
    return;
}
$controllerObject = new $controllerName();
echo $controllerObject->run($action);