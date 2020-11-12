<?php
namespace App\models;

class Category extends Model
{
    protected function getTableName(): string
    {
        return 'categories';
    }
}