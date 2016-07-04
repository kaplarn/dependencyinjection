<?php

namespace Kaplarn\DependencyInjection;

use Kaplarn\Annotation\Annotation;

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
     * @param String $class
     * @return Mixed
     */
    public function create($class)
    {
        $object = new $class();
        $reflectionClass = new \ReflectionClass($class);
        
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            $annotation = new Annotation($method->getDocComment());
            $value = $annotation->getValue();
            
            if (!$value) {
                continue;
            }
            
            $realValue = $annotation->hasNewInstance() && $annotation->getNewInstance()
                ? $this->container->getNewInstance($value)
                : $this->container->get($value);
            
            $object->{$method->getName()}($realValue);
        }
        
        foreach ($reflectionClass->getProperties() as $property) {
            $annotation = new Annotation($property->getDocComment());
            $value = $annotation->getValue();

            if (!$value) {
                continue;
            }

            $realValue = $annotation->hasNewInstance() && $annotation->getNewInstance()
                ? $this->container->getNewInstance($value)
                : $this->container->get($value);
            
            $method = 'set' . ucfirst($property->getName());
            $object->{$method}($realValue);
        }
        
        return $object;
    }
}
