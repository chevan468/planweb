<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    /**
     * @group user
     * para correr las pruebas digitar vendor/bin/phpunit
     * A basic test example.
     * @covers User::create
     * @return void
     */

        public function testIndex()
    {
        $this->visit('user');
    }
    
    public function testListAll(){
        $this->visit('user')
        ->see('Nombre')
        ->see('Apellidos')
        ->see('Estudio');
    }
    
    public function testCreateUser(){
        
        $myObject = new User();
        $myFactory = $this->getMock('ObjectFactory', array('getRandomObject'));
        $myFactory->expects($this->any())->method('getRandomObject')->will($this->returnValue($myObject));

        $this->assertInstanceOf('App\User', $myFactory->getRandomObject());
    }
    
    public function testEdit(){


    
    }
    
    
    
    
}
