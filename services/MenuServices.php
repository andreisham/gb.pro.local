<?php


namespace App\services;


use App\models\User;
use App\controllers\Controller;

class MenuServices
{
    public function getMenu(Request $request)
    {
        $baseMenu = <<<HTML
    <li><a href="/?c=user&a=index">Главная</a></li>
    <li><a href="/?c=user&a=all">Все пользователи</a></li>
    <li><a href="/?c=good&a=all">Все товары</a></li>
HTML;
        $dopMenu = <<<HTML
    <li><a href="/?c=auth&a=add">Регистрация</a></li>
    <li><a href="/?c=auth&a=in">Авторизация</a></li>
HTML;

        $user = unserialize (serialize ($request->getSession('user')));
        if (!empty($user)) {
            $dopMenu = <<<HTML
    <li><a href="/?c=auth&a=exit">Выход</a></li>
HTML;
            if ($user->is_admin) {
                $dopMenu .= <<<HTML
    <li><a href="/?c=user&a=add">Добавить пользователя</a></li>
    <li><a href="/?c=good&a=add">Добавить товар</a></li>
HTML;
            }
        }
        return $baseMenu . $dopMenu;
    }
}