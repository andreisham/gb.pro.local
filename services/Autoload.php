<?php
namespace App\services;

class Autoload
{
    public function loadClass($className){
        $dir = dirname(__DIR__) . substr($className, 3);
        $fileName = $dir . '.php';
        if (file_exists($fileName)){
            include $fileName;
        }
    }
}

