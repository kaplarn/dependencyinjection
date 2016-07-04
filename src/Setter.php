<?php

namespace Kaplarn\DependencyInjection;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
trait Setter
{
    /**
     * @param String $name
     * @param [] $arguments
     */
    public function __call($name, $arguments)
    {
        if (strpos($name, 'set') === 0) {
            $property = lcfirst(preg_replace('/^set/', '', $name));
            $this->{$property} = $arguments[0];
        }
    }
}
