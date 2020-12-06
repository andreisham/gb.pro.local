<?php
namespace App\controllers;

use App\models\Good;
use App\models\User;
use App\services\DB;

class GoodController
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
            'good',
            [
                'good' => (new Good())->getOne($id)
            ]
        );
    }
    public function allAction()
    {
        return $this->render(
            'goods',
            [
                'goods' => (new Good())->getAll()
            ]
        );
    }
    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->render('good_add');
        }
        $good = new Good();
        $good->name = $_POST['name'];
        $good->price = $_POST['price'];
        $good->save();
        (new DB)->redirect('/?c=good&a=all');
    }
    public function editAction()
    {
        $id = (int) $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            return $this->render('good_edit',
                ['good' => (new Good())->getOne($id)]);
        }
        $good = new Good();
        $good->name = $_POST['name'];
        $good->price = $_POST['price'];
        $good->id = $id;
        $good->save();
        (new DB)->redirect("/?c=good&a=one&id={$id}");
    }
    public function delAction()
    {
        $id = (int) $_GET['id'];
        $good = new Good();
        $good->id = $id;
        $good->delete();
        (new DB)->redirect("/?c=good&a=all");
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