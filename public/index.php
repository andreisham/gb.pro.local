<?php
include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([(new App\services\Autoload()), 'loadClass']);

$user = new \App\models\User();


$db = new \App\services\DB();
$user = new \App\models\User($db);
$order = new \App\models\Order($db);
$category = new \App\models\Category($db);
$goodImage = new \App\models\GoodImage($db);
$good = new \App\models\Good($db);

