<?php
// Класс для создания ценника товара
class PriceTag
{
private $id; // id товара
public $name; // название товара
public $price; // цена
public $code; // сюда можно передавать изображение штрих-кода из базы

/**
* PriceTag constructor.
* @param $id
* @param $name
* @param $price
* @param $code
*/
public function __construct($id, $name, $price, $code)
{
$this->id = $id;
$this->name = $name;
$this->price = $price;
$this->code = $code;
}


public function echoPriceTag()
{
echo <<<php
<h1> {$this->name} </h1>
<p> {$this->price} </p>
<img src="{$this->code}" width="100px">
php;
}
}

// класс для создания ценников со скидкой
// (не уверен насколько он нужен именно как отдельный класс)
class SalePriceTag extends PriceTag
{

public function makeDiscount($discount)
{
$this->price = $this->price - ($this->price * $discount);
}
}

$tag = new PriceTag(1, 'Товар 1', 100, '/img/unnamed.png');
$tag->echoPriceTag();
$saleTag = new SalePriceTag(2, 'Товар 2 sale', 100, '/img/unnamed.png');
$saleTag->makeDiscount(0.20);
$saleTag->echoPriceTag();
