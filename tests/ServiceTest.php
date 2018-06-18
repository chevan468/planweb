<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Service;

class ServiceTest extends TestCase
{
    /**
     * para correr las pruebas digitar vendor/bin/phpunit
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->visit('services');
    }
    
    public function testListAll(){
        $this->visit('services')
        ->see('Servicios');
    }
    
    public function testCreateService(){
        
        $myObject = new Service();
        $myFactory = $this->getMock('ObjectFactory', array('getRandomObject'));
        $myFactory->expects($this->any())->method('getRandomObject')->will($this->returnValue($myObject));

        $this->assertInstanceOf('App\Service', $myFactory->getRandomObject());
    }
    
    // public function testUserCanCreateService(){
    //     $this-> visit('listallservice')
    //     ->click('nuevo')
    //     ->type('Electricista','name')
    //     ->type('Electricista de prueba','description')
    //     ->type ('8000','price')
    //     ->type('150 despues del test','fullAddress')
    //     ->type('89414072','contactNumber')
    //     ->type('ejemplo@test.com','contactEmail')
    //     ->press('Grabar');
    // }
}
