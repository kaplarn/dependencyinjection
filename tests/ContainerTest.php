<?php

namespace Kaplarn\DependencyInjection\Tests;

use Kaplarn\DependencyInjection\Container;
use Kaplarn\DependencyInjection\Factory;
use Kaplarn\DependencyInjection\Service;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    protected $container;
    
    /**
     * Set up
     */
    public function setUp()
    {
        $this->container = new Container();
        $this->container->setFactory(new Factory());
        $this->container->setService(new Service([dirname(__FILE__) . '/Stub/Service']));
    }
    
    /**
     * @covers Container::set
     * @covers Container::get
     */
    public function testSetAndGet()
    {
        $this->container->set('key', 'value');
        $this->assertEquals('value', $this->container->get('key'));
    }
    
    /**
     * @covers Container::get
     */
    public function testGetClass()
    {
        $classA = $this->container->get('\Kaplarn\DependencyInjection\Tests\Stub\ClassA');
        
        $this->assertInstanceOf('\Kaplarn\DependencyInjection\Tests\Stub\ClassA', $classA);
        $this->assertInstanceOf('\Kaplarn\DependencyInjection\Tests\Stub\ClassB', $classA->getClassB());
    }
    
    /**
     * @covers Container::get
     */
    public function testGetNewInstance()
    {
        $classB1 = $this->container->getNewInstance('\Kaplarn\DependencyInjection\Tests\Stub\ClassB');
        $classB2 = $this->container->getNewInstance('\Kaplarn\DependencyInjection\Tests\Stub\ClassB');
        
        $this->assertTrue($classB1 !== $classB2);
    }
    
    /**
     * @covers Container::get
     */
    public function testGetService()
    {
        $cache = $this->container->get('Cache');
        $this->assertInstanceOf('\Kaplarn\DependencyInjection\Tests\Stub\Cache\ICache', $cache);
    }
}
