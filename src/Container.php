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
     * @var Service
     */
    protected $service;
    
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
     * @param Service $service
     */
    public function setService(Service $service)
    {
        $this->service = $service;
        $this->service->setContainer($this);
    }
    
    /**
     * @param String $id
     * @param Mixed $value
     */
    public function set($id, $value)
    {
        $this->data[$id] = $value;
    }
    
    /**
     * @param String $id
     * @return Mixed
     */
    public function get($id)
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }
        
        if (class_exists($id)) {
            $this->data[$id] = $this->factory->create($id);
            return $this->data[$id];
        }
        
        if ($this->service->has($id)) {
            $this->data[$id] = $this->service->get($id);
        }

        return isset($this->data[$id]) ? $this->data[$id] : null;
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