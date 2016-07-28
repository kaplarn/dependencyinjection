<?php

namespace Kaplarn\DependencyInjection;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class Container
{
    /**
     * @var Factory
     */
    protected $factory;
    
    /**
     * @var []
     */
    protected $data = [];
    
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
     * @param String $id
     * @param null $default
     * @return Mixed
     */
    public function get($id, $default = null)
    {
        if (array_key_exists($id, $this->data)) {
            return $this->data[$id];
        }
        
        if (class_exists($id)) {
            return $this->data[$id] = $this->factory->create($id);
        }
        
        return $default;
    }
    
    /**
     * @param String $class
     * @return Mixed
     */
    public function getNewInstance($class)
    {
        return $this->factory->create($class);
    }
}