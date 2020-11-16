<?php
namespace App\controllers;


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
        return 'index';
    }
    public function allAction()
    {
        return 'all';
    }
}