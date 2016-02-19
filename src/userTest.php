<?php

require_once('user.php');

class ProductTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorAndGetters()
    {
        $id = 1;
        $email = 'xxx@xxx.pl';
        $name = 'name';
        $address = 'address';
        $testUser = new User($id, $email, $name, $address);

        $this->assertEquals($id, $testUser->getId());
        $this->assertEquals($email, $testUser->getEmail());
        $this->assertEquals($name, $testUser->getName());
        $this->assertEquals($address, $testUser->getAddress());
    }
    public function testLogInUser()
    {
        $email = 'test1@test.pl';
        $password = '1234';
        $testUser = User::LogInUser($email, $password);
        $test = new User(1, 'Test name1', $email, 'Test opis1');
        $this->assertSame($test, $testUser);
    }
}