<?php

namespace Kaplarn\DependencyInjection\Tests\PHPUnit;

use Kaplarn\DependencyInjection\Container;
use Kaplarn\DependencyInjection\Factory;

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
    }
    
    /**
     * @covers Container::setFactory
     * @covers Container::getFactory
     */
    public function testSetAndGetFactory()
    {
        $this->container->setFactory(new Factory());
        $this->assertInstanceOf(Factory::class, $this->container->getFactory());
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
    public function testGetNewInstance()
    {
        $classB1 = $this->container->getNewInstance('\Kaplarn\DependencyInjection\Tests\PHPUnit\Stub\ClassB');
        $classB2 = $this->container->getNewInstance('\Kaplarn\DependencyInjection\Tests\PHPUnit\Stub\ClassB');
        
        $this->assertTrue($classB1 !== $classB2);
    }
}
