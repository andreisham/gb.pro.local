<?php
namespace App\controllers;

use App\models\User;
use App\services\DB;

class UserController
{
    protected $defaultAction = 'index';

    public function run($action)
    {
        if(empty($action)){
            $action= $this->defaultAction;
        }
        $action .= 'Action';
        if(!method_exists($this, $action)){
            return '404';
        }
        return $this->$action();
    }
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
        (new DB)->redirect("/?c=user&a=one&id={$id}");
    }
    protected function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layouts/main',
            ['content' => $content]);
    }
    protected function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}