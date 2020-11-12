<?php
namespace App\models;

class User extends Model
{
    public $id;
    public $login;
    public $password;

    protected function getTableName(): string
    {
        return 'users';
    }
}