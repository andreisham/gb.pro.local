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
        $id = (int) $_GET['id'];

        return $this->render(
            'user',
            [
                'user' => (new User())->getOne($id)
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
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->render('user_add');
        }
        $user = new User();
        $user->login = $_POST['login'];
        $user->password = $_POST['password'];
        $user->save();
        $this->setMSG('Пользователь добавлен');
        (new DB)->redirect('/?c=user&a=all');
    }
    public function editAction()
    {
        $id = (int) $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->render('user_edit',
                ['user' => (new User())->getOne($id)]);
        }
        $user = new User();
        $user->login = $_POST['login'];
        $user->password = $_POST['password'];
        $user->id = $id;
        $user->save();
        $this->setMSG('Пользователь обновлен');
        (new DB)->redirect("/?c=user&a=one&id={$id}");
    }
}