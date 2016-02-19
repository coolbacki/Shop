<?php
require_once ('connection.php');

class TestItem extends PHPUnit_Framework_TestCase
{
    public function testMakeOrder()
    {

        $inputName = 'dawid';
        $inputDescription = 'krakowska' ;
        $inputPrice = 15.99;
        $inputQuantity = 2;
        $testOrder = new Item($inputName, $inputDescription, $inputPrice, $inputQuantity);


        $result = $testOrder->CreateItem($inputName, $inputDescription, $inputPrice, $inputQuantity);
        $this->assertEquals(,$result);

    }
}