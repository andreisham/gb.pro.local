<?php
namespace App\controllers;

use App\models\User;
use App\services\DB;

class UserController extends Controller
{
    protected $defaultAction = 'index';

    public function indexAction()
    {
        return $this->render(
            'index',
            [
                'title' => 'Название',
                'text' => 'lorem'
            ]
        );
    }
    public function oneAction()
    {
        $id = $this->request->get('id');
        return $this->render(
            'user',
            [
                'user' => (new User())->getOne($id),
                'admin' => unserialize (serialize ($this->request->getSession('user'))),
            ]
        );
    }
    public function allAction()
    {
        return $this->render(
            'users',
            [
                'users' => (new User())->getAll()
            ]
        );
    }
    public function addAction()
    {
        if ($this->request->isGet()){
            return $this->render('user_add');
        }
        $user = new User();
        $user->login = $this->request->post('login');
        $user->password = $this->request->post('password');
        $user->save();
        $this->setMSG('Пользователь добавлен');
        $this->request->redirect('/?c=user&a=all');
    }
    public function editAction()
    {
        $id = $this->request->get('id');
        if ($this->request->isGet()){
            return $this->render('user_edit',
                ['user' => (new User())->getOne($id)]);
        }
        $user = new User();
        $user->login = $this->request->post('login');
        $user->password = $this->request->post('password');
        $user->id = $id;
        $user->save();
        $this->setMSG('Пользователь обновлен');
        $this->request->redirect("/?c=user&a=one&id={$id}");
    }
}