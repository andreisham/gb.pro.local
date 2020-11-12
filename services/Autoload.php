<?php
namespace App\services;

class Autoload
{
    public function loadClass($className)
    {
        $basedir = dirname(__DIR__) . '/';
        $fileName = str_replace(
            ['App\\', '\\'],
            [$basedir, '/'],
            $className
        ) . '.php';
        if (file_exists($fileName)) {
            include $fileName;
        }
    }
}

