<?php
// создание класса сохранения информации о товарах
class Good
{
    const ERROR_TEST = 1;
    const ERROR_TEST2 = 2;

    public static $test;   // статичная переменная

    public $id;
    public $name;
    public $info;
    public $price;


    public function echoSome(){
        static::ERROR_TEST; // обращение к константам внутри класса
        echo <<<php
            название: {$this->name} <br>
            <h1>{$this->price}</h1>
php;
    }
}

Good::ERROR_TEST; // обращение к константам класса
Good::$test;
//$good = new Good();
//$good->id = 12; // ввод числа 12 в свойство класса
//$good->name = 'Товар 1';
//$good->info = 'Информация';
//$good->price = 100;
//
//$name = 'info';
//$good->$name = '123';
//
//$good->echoSome();
//
//
//var_dump($good);



