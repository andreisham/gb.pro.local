<?php
namespace App\controllers;

use App\models\User;

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