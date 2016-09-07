<?php

namespace Kaplarn\DependencyInjection;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class Container
{
    /**
     * @var Container
     */
    static protected $container;
    
    /**
     * @var Factory
     */
    protected $factory;
    
    /**
     * @var []
     */
    protected $data = [];

    /**
     * @return Container
     */
    public static function getInstance()
    {
        if (!self::$container) {
            self::$container = new self();
            self::$container->setFactory(new Factory());
        }
        
        return self::$container;
    }
    
    /**
     * @param Factory $factory
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        $this->factory->setContainer($this);
    }
    
    /**
     * @return Factory
     */
    public function getFactory() : Factory
    {
        return $this->factory;
    }

    /**
     * @param string $id
     * @param mixed $value
     */
    public function set(string $id, $value)
    {
        $this->data[$id] = $value;
    }
    
    /**
     * @param string $id
     * @param null $default
     * @param bool $disableSetters
     * @return mixed
     */
    public function get(string $id, $default = null, bool $disableSetters = false)
    {
        if (array_key_exists($id, $this->data)) {
            return $this->data[$id];
        }
        
        if (class_exists($id)) {
            return $this->data[$id] = $this->factory->create($id, $disableSetters);
        }
        
        return $default;
    }
    
    /**
     * @param string $class
     * @param bool $disableSetters
     * @return mixed
     */
    public function getNewInstance(string $class, bool $disableSetters = false)
    {
        return $this->factory->create($class, $disableSetters);
    }
}