<?php
namespace App\models;

class Order extends Model
{
    protected function getTableName(): string
    {
        return 'orders';
    }
}