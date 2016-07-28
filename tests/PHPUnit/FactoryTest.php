<?php

namespace Kaplarn\DependencyInjection\Tests;

use Kaplarn\DependencyInjection\Container;
use Kaplarn\DependencyInjection\Factory;

use Kaplarn\DependencyInjection\Tests\PHPUnit\Stub\ClassA;
use Kaplarn\DependencyInjection\Tests\PHPUnit\Stub\ClassB;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class FactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Factory
     */
    protected $factory;
    
    /**
     * Set up
     */
    public function setUp()
    {
        $this->factory = new Factory();
        
        $container = new Container();
        $container->setFactory($this->factory);
    }
    
    /**
     * @covers Container::set
     * @covers Container::get
     */
    public function testSetAndGetContainer()
    {
        $container = new Container();
        $factory = new Factory();
        $factory->setContainer($container);
        
        $this->assertInstanceOf(Container::class, $container);
    }
    
    /**
     * @covers Factory::create
     */
    public function testCreate()
    {
        $classA = $this->factory->create(ClassA::class);
        $this->assertInstanceOf(ClassA::class, $classA);
        
        $classB1 = $classA->getClassB1();
        $classB2 = $classA->getClassB2();
        $classB3 = $classA->getClassB3();
        $classB4 = $classA->getClassB4();
        
        $this->assertTrue($classB1 === $classB2);
        $this->assertTrue($classB1 !== $classB3);
        $this->assertTrue($classB3 !== $classB4);
    }
}
