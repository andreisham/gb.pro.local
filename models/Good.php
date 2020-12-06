<?php
namespace App\models;

class Good extends Model
{
    public $id;
    public $name;
    public $price;

    protected function getTableName(): string
    {
        return 'goods';
    }
}