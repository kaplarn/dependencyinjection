<?php

namespace Kaplarn\DependencyInjection;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class Factory
{
    /**
     * @var Container
     */
    protected $container;
    
    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * @return Container
     */
    public function getContainer() : Container
    {
        return $this->container;
    }
    
    /**
     * @param string $class
     * @param bool $disableSetters
     * @return mixed
     */
    public function create(string $class, bool $disableSetters = false)
    {
        $object = new $class();
        if (!$disableSetters) {
            $this->setUpObject($class, $object);
        }
        
        return $object;
    }

    /**
     * @param string $class
     * @param mixed $object
     * @return mixed
     */
    protected function setUpObject(string $class, $object)
    {
        foreach ($this->getPublicSetterMethods($class) as $method) {
            if (!$method->getNumberOfParameters()) {
                continue;
            }
            
            $parameter = $method->getParameters()[0];
            $value = $parameter->hasType() && class_exists((string)$parameter->getType())
                ? $this->getValueByType($method, $parameter)
                : $this->getValueByName($parameter);

            $object->{$method->getName()}($value);
        }
        
        return $object;
    }
    
    /**
     * @param string $class
     * @return \ReflectionMethod[]
     */
    protected function getPublicSetterMethods(string $class) : array
    {
        $reflectionClass = new \ReflectionClass($class);
        
        $result = [];
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (!$this->isSetter($method)) {
                continue;
            }
            
            $result[] = $method;
        }
        
        return $result;
    }
    
    /**
     * @param \ReflectionMethod $method
     * @return bool
     */
    protected function isSetter(\ReflectionMethod $method) : bool
    {
        $name = $method->getName();
        
        return 
            strpos($name, 'set') === 0
            && strtolower($name[3]) !== $name[3];
    }
    
    /**
     * @param \ReflectionMethod $method
     * @param \ReflectionParameter $parameter
     * @return mixed
     */
    protected function getValueByType(\ReflectionMethod $method, \ReflectionParameter $parameter)
    {
        $type = (string)$parameter->getType();
        $default = $parameter->isOptional() ? $parameter->getDefaultValue() : null;
        
        return $this->needNewInstance($method)
            ? $this->container->getNewInstance($type)
            : $this->container->get($type, $default);
    }

    /**
     * @param \ReflectionParameter $parameter
     * @return mixed
     */
    protected function getValueByName(\ReflectionParameter $parameter)
    {
        $name = $parameter->getName();
        $default = $parameter->isOptional() ? $parameter->getDefaultValue() : null;
        
        return $this->container->get($name, $default);
    }
    
    /**
     * @param \ReflectionMethod $method
     * @return bool
     */
    protected function needNewInstance(\ReflectionMethod $method) : bool
    {       
        $name = $method->getName();
        
        return
            strpos($name, 'New') === 3
            && strtolower($name[6]) !== $name[6];
    }
}
