<?php
namespace App\services;

class DB implements IDB
{
    public function getAll($sql, $params = []){
        return 'getAll: ' . $sql . '<br>';
    }
    public function getOne($sql, $params = []){
        return 'getOne: ' . $sql . '<br>';
    }

    public function exec($sql, $params = [])
    {
        // TODO: Implement exec() method.
    }
}