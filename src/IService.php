<?php

namespace Kaplarn\DependencyInjection;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
interface IService
{
    /**
     * @return Mixed
     */
    public function getService();
}
