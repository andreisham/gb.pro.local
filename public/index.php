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


$db = new \App\services\DB();
$user = new \App\models\User($db);
$order = new \App\models\Order($db);
$category = new \App\models\Category($db);
$goodImage = new \App\models\GoodImage($db);
$good = new \App\models\Good($db);

