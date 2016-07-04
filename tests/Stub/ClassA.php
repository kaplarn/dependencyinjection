<?php

namespace Kaplarn\DependencyInjection\Tests\Stub;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class ClassA
{
    /**
     * @var ClassB
     */
    protected $classB;
    
    /**
     * ['value' => '\Kaplarn\DependencyInjection\Tests\Stub\ClassB']
     * 
     * @param ClassB $classB
     */
    public function setClassB($classB)
    {
        $this->classB = $classB;
    }
    
    /**
     * @return ClassB
     */
    public function getClassB()
    {
        return $this->classB;
    }
}