<?php
session_start();
include dirname(__DIR__) . '/vendor/autoload.php';
$config = include dirname(__DIR__) . '/engine/config.php';
$request = new \App\services\Request();

echo (new \App\engine\App())->run($request, $config);

