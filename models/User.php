<?php
namespace App\models;

class User extends Model
{
    public $id;
    public $login;
    public $password;
    public $is_admin;

    protected function getTableName(): string
    {
        return 'users';
    }
    public function getByLogin($login)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE login = :login";
        $params = [':login' => $login];
        return $this->getDB()->getOneObject($sql,static::class, $params);
    }
}