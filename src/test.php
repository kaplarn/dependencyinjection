<?php

namespace Kaplarn\DependencyInjection;

require_once dirname(__FILE__) . '/Factory.php';

class TestClass
{
    /**
     * @var Int
     */
    protected $limit = 0;
    
    /**
     * @param int $limit
     */
    public function setLimit(int $limit = 0)
    {
        $this->limit = $limit;
    }
}

//$factory = new Factory();
//$class = $factory->create('\Kaplarn\DependencyInjection\TestClass');

//var_dump($class);
var_dump(TestClass::class);
exit;