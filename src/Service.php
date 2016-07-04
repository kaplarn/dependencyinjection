<?php

namespace Kaplarn\DependencyInjection;

/**
 * @author Káplár Norbert <kaplarnorbert@webshopexperts.hu>
 */
class Service
{
    /**
     * @var Container
     */
    protected $container;
    
    /**
     * @var []
     */
    protected $services = [];
    
    /**
     * @param [] $directories
     */
    public function __construct(Array $directories = [])
    {
        $this->services = $this->loadServices($directories);
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }
    
    /**
     * @param String $service
     * @return Bool
     */
    public function has($service)
    {
        return isset($this->services[$service]);
    }
    
    /**
     * @param String $service
     * @return Mixed
     */
    public function get($service)
    {
        if (!$this->has($service)) {
            return null;
        }
        
        $serviceProvider = $this->container->getNewInstance($this->services[$service]);
        if (! $serviceProvider instanceof IService) {
            throw new \Exception($this->services[$service] . ' must be implement IService!');
        }
        
        return $serviceProvider->getService();
    }
    
    /**
     * @return []
     */
    public function getServices()
    {
        return $this->services;
    }
    
    /**
     * @param [] $directories
     * @return []
     */
    protected function loadServices(Array $directories = [])
    {
        $services = [];
        foreach ($directories as $directory) {
            foreach (glob($directory . '/*.php') as $file) {
                $name = str_replace([$directory . '/', '.php'], ['', ''], $file);
                $class = $this->getClass($file);
                $services[$name] = $class;
            }
        }

        return $services;
    }
    
    /**
     * @param String $file
     * @return String
     */
    protected function getClass($file)
    {
        $content = file_get_contents($file);
        return $this->getNamespace($content) . '\\' . $this->getClassName($content);
    }
    
    /**
     * @param String $content
     * @return String
     */
    protected function getNamespace($content)
    {
        $match = [];
        if (preg_match('/namespace (.*);/', $content, $match)) {
            return $match[1];
        }
    }
    
    /**
     * @param String $content
     * @return String
     */
    protected function getClassName($content)
    {
        $match = [];
        if (preg_match('/class ([^\ ]*)/', $content, $match)) {
            return $match[1];
        }
    }
}
