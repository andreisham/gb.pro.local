<?php
define('IMG_DIR', dirname(__DIR__) . '/public/img/');
return [
    'appName' => 'Мой магазин',
    'defaultController' => 'good',
    'components' => [
        'menuService' => [
            'class' => \App\services\MenuServices::class,
        ],
        'renderer' => [
            'class' => \App\services\renders\TwigRenderer::class,
        ],
        'userService' => [
            'class' => \App\services\UserServices::class,
        ],
        'goodService' => [
            'class' => \App\services\GoodServices::class,
        ],
    ],
];

