<?php

namespace Kaplarn\DependencyInjection\Tests;

use Kaplarn\DependencyInjection\Factory;

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
        
        $containerMock = $this
            ->getMockBuilder('\Kaplarn\DependencyInjection\Container')
            ->disableOriginalConstructor()
            ->getMock('\Kaplarn\DependencyInjection\Container');
            
        $containerMock
            ->method('get')
            ->willReturn(null);
                
        $this->factory->setContainer($containerMock);
    }
    
    /**
     * @covers Factory::create
     * @dataProvider provider
     * 
     * @param String $class
     */
    public function testCreate($class)
    {
        $actual = $this->factory->create($class);
        $this->assertInstanceOf($class, $actual);
    }
    
    /**
     * @return []
     */
    public function provider()
    {
        return
            [
                ['\Kaplarn\DependencyInjection\Tests\Stub\ClassA'],
                ['\Kaplarn\DependencyInjection\Tests\Stub\ClassB']
            ];
    }
}
