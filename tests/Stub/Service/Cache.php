<?php

namespace Kaplarn\DependencyInjection\Tests\Stub\Service;

use Kaplarn\DependencyInjection\IService;
use Kaplarn\DependencyInjection\Tests\Stub\Cache\ICache;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class Cache implements IService
{
    /**
     * @var ICache
     */
    protected $service;
    
    /**
     * ['value' => '\Kaplarn\DependencyInjection\Tests\Stub\Cache\Filecache']
     * 
     * @param ICache $cache
     */
    public function setService(ICache $cache)
    {
        $this->service = $cache;
    }
    
    /**
     * @return ICache
     */
    public function getService()
    {
        return $this->service;
    }
}
