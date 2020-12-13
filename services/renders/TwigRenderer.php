<?php


namespace App\services\renders;


use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer implements IRenderer
{
    protected $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader([
            dirname(__DIR__, 2) . '/twig/',
            dirname(__DIR__, 2) . '/twig/layouts',
        ]);
        $this->twig = new Environment($loader);
    }

    public function render($template, $params = [])
    {
        $template .= '.twig';
        return $this->twig->render($template,$params);
    }

}