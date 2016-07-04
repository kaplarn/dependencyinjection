<?php

namespace Kaplarn\DependencyInjection\Tests\Stub;

use Kaplarn\DependencyInjection\Setter;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class ClassA
{
    use Setter;
    
    /**
     * @var ClassB
     */
    protected $classB;
    
    /**
     * ['value' => '\Kaplarn\DependencyInjection\Tests\Stub\ClassC']
     * 
     * @var ClassC
     */
    protected $classC;
    
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
    
    /**
     * @return ClassC
     */
    public function getClassC()
    {
        return $this->classC;
    }
}