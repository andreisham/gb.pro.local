<?php


namespace App\services;

class Request
{
    protected $params = [
        'post' => [],
        'get' => []
    ];

    public function __construct()
    {
        session_start();
        $this->setParams();

    }
    protected function setParams()
    {
        $this->params = [
            'post' => $_POST,
            'get' => $_GET,
            'file' => $_FILES
        ];
    }
    public function get($key = '')
    {
        if (empty($key)) {
            return $this->params['get'];
        }
        if (key_exists($key, $this->params['get'])) {
            return $this->params['get'][$key];
        }
        return null;
    }
    public function post($key = '')
    {
        if (empty($key)) {
            return $this->params['post'];
        }
        if (key_exists($key, $this->params['post'])) {
            return $this->params['post'][$key];
        }
        return null;
    }
    public function file($key = '')
    {
        if (empty($key)) {
            return $this->params['file'];
        }
        if (key_exists($key, $this->params['file'])) {
            return $this->params['file'][$key];
        }
        return null;
    }
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    public function redirect($path = '')
    {
        $referer = '/';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $referer = $_SERVER['HTTP_REFERER'];
        }
        if (empty($path) && !empty($referer)) {
            $path = $referer;
        }
        header('Location: ' . $path);
    }
    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }
        if (key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }
        return null;
    }
}