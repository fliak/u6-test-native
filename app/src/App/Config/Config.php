<?php

namespace App\Config;

/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 18.39
 */
class Config
{
    
    protected static $config = [];

    /**
     * @param string $resource
     * @return array
     */
    public function load($resource)
    {
        if (!file_exists($resource)) {
            throw new \InvalidArgumentException(sprintf('The file "%s" is missing.', $resource));
        }

        $config = include $resource;
        
        self::$config = $config;
    }
    
    public static function getParam($name, $default = null) {
        if (array_key_exists($name, self::$config)) {
            return self::$config[$name];
        }
        
        return $default;
    }

}