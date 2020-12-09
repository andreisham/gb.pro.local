<?php


namespace App\tests;


use App\services\MenuServices;
use App\services\Request;
use PHPUnit\Framework\TestCase;

class MyTest extends TestCase
{
    /**
     * @param $c
     * @param $a
     * @param $b
     *
     * @dataProvider getDataForTest //это надо указывать чтоб тест получал значения из массива в функции
     */
    public function testFirst($c, $a, $b)
    {
        $res = $a + $b;
        $this->assertEquals($c, $res);
    }
    public function getDataForTest()
    {
        return [
            [4, 2, 2],
            [5, 3, 2],
            [6, 4, 2],
        ];
    }
    public function testGetMenu()
    {
        $mockRequest = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockRequest->expects($this->once())
            ->method('getSession')
            ->willReturn('test');
        $menuServices = new MenuServices();
        $menuServices->getMenu($mockRequest);
    }
    // reflectionMethod и setAccessible применяются для доступа к защищенным функциям
}