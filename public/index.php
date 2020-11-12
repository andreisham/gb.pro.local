<?php
include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([(new App\services\Autoload()), 'loadClass']);

$user = new \App\models\User();

$user->login = 'ytrq123';
$user->password = 'ddd3';
$user->id = 61;

$user->save();

$good = new \App\models\Good();

$good->price = 1000;
$good->name = 'NEW ONE';
$good->id = 5;

$good->save();

$good->delete();
