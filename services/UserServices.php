<?php


namespace App\services;


use App\models\User;

class UserServices
{
    public function saveUser($params, User $user = null)
    {
        if (empty($user)){
            $user = new User();
        }

        $user->login = $params['login'];
        $user->password = password_hash($params['password'], PASSWORD_DEFAULT);
        $user->is_admin = (int)$params['is_admin'];
        $user->save();
    }
    public function getUser($login)
    {
        return (new User())->getByLogin($login);
    }
}