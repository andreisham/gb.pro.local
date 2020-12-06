<?php

namespace App\services;

trait TSingleton
{
    static protected $item;

    protected function __constract(){}
    protected function __clone(){}
    protected function __wakeup(){}

    static public function instanse()
    {
        if(empty(static::$item)){
            static::$item = new static();
        }
        return static::$item;
    }
}