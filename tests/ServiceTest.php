<?php

namespace Kaplarn\DependencyInjection\Tests;

use Kaplarn\DependencyInjection\Container;
use Kaplarn\DependencyInjection\Factory;
use Kaplarn\DependencyInjection\Service;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Service
     */
    protected $service;
    
    /**
     * Set up
     */
    public function setUp()
    {
        $container = new Container();
        $container->setFactory(new Factory());
        $this->service = new Service([dirname(__FILE__) . '/Stub/Service']);
        $this->service->setContainer($container);
    }
    
    /**
     * @covers Factory::create
     * 
     * @param String $class
     */
    public function testCreate()
    {
        $expected = '\Kaplarn\DependencyInjection\Tests\Stub\Cache\ICache';
        $actual = $this->service->get('Cache');
        $this->assertInstanceOf($expected, $actual);
    }
}
