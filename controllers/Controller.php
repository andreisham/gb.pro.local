<?php

namespace App\controllers;

use App\engine\Container;
use App\models\Review;
use App\services\MenuServices;
use App\services\renders\IRenderer;
use App\services\renders\TmplRenderer;
use App\services\Request;

abstract class Controller
{
    protected $renderer;
    public function __construct(IRenderer $renderer, Request $request, Container $container)
    {
        $this->renderer = $renderer;
        $this->request = $request;
        $this->container = $container;
    }

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
        $params['msg'] = $this->getMSG();
        $params['menu'] = $this->container->menuService->getMenu($this->request);
        return $this->renderer->render($template, $params);
    }
    protected function setMSG($msg)
    {
        $this->request->setSession('MSG', $msg);
    }
    protected function getMSG()
    {
        if (empty($this->request->getSession('MSG'))){
            return '';
        }
        $msg = $this->request->getSession('MSG');
        $this->request->setSession('MSG', '');
        return $msg;
    }
    protected function getId()
    {
        return (int)$this->request->get('id');
    }

    protected function isGet()
    {
        return (int)$this->request->isGet();
    }

}