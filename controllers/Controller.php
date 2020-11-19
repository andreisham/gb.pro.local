<?php

namespace App\controllers;

abstract class Controller
{
    protected $defaultAction = 'all';

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
    protected function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layouts/main',
            [
                'content' => $content,
                'message' => $this->getMSG()
            ]);
    }
    protected function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
    protected function setMSG($message)
    {
        $_SESSION['MSG'] = $message;
    }
    protected function getMSG()
    {
        if (empty($_SESSION['MSG'])){
            return '';
        }
        $message = $_SESSION['MSG'];
        $_SESSION['MSG'] = '';
        return $message;
    }

}