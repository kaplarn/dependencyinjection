<?php

namespace Kaplarn\DependencyInjection\Tests\PHPUnit\Stub;

use Kaplarn\DependencyInjection\Tests\PHPUnit\Stub\ClassB;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class ClassA
{
    /**
     * @var ClassB
     */
    protected $classB1;
    
    /**
     * @var ClassB
     */
    protected $classB2;
    
    /**
     * @var ClassB
     */
    protected $classB3;
    
    /**
     * @var ClassB
     */
    protected $classB4;
    
    /**
     * @param ClassB $classB
     */
    public function setClassB1(ClassB $classB)
    {
        $this->classB1 = $classB;
    }

    /**
     * @return ClassB
     */
    public function getClassB1() : ClassB
    {
        return $this->classB1;
    }
    
    /**
     * @param ClassB $classB
     */
    public function setClassB2(ClassB $classB)
    {
        $this->classB2 = $classB;
    }
    
    /**
     * @return ClassB
     */
    public function getClassB2() : ClassB
    {
        return $this->classB2;
    }
    
    /**
     * @param ClassB $classB
     */
    public function setNewClassB3(ClassB $classB)
    {
        $this->classB3 = $classB;
    }
    
    /**
     * @return ClassB
     */
    public function getClassB3() : ClassB
    {
        return $this->classB3;
    }
    
    /**
     * @param ClassB $classB
     */
    public function setNewClassB4(ClassB $classB)
    {
        $this->classB4 = $classB;
    }
    
    /**
     * @return ClassB
     */
    public function getClassB4() : ClassB
    {
        return $this->classB4;
    }
}
