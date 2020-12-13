<?php

namespace App\controllers;

use App\models\User;
use App\services\UserServices;

class AuthController extends Controller
{
    public function addAction()
    {
        if ($this->isGet()){
            return $this->render('auth_add');
        }
        $this->container->userService->saveUser($this->request->post());

        $this->setMSG('Вы зарегистрированы');
        $this->request->redirect();
        return '';
    }
    public function inAction()
    {
        if (!empty($this->request->getSession('user'))) {
            $this->request->redirect('/');
            return '';
        }
        if ($this->isGet()){
            return $this->render('auth_in');
        }
        $user = (new User())->getByLogin($this->request->post('login'));

        if (empty($user)){
            $this->setMSG('Вы не авторизованы');
            $this->request->redirect();
            return '';
        }
        $this->request->setSession('user', $user);
        $this->setMSG('Вы авторизованы');
        $this->request->redirect('/');
        return '';
    }
    public function exitAction()
    {
        $this->request->setSession('user', '');
        $this->request->redirect('/');
        return '';
    }
}
