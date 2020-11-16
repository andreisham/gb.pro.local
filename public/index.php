<?php
include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([(new App\services\Autoload()), 'loadClass']);

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