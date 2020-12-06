<?php
namespace App\models;

class GoodImage extends Model
{
    public $id;
    public $good_id;
    public $path;

    protected function getTableName(): string
    {
        return 'good_images';
    }
}