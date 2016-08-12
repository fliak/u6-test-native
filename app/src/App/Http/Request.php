<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 23.07
 */

namespace App\Http;


class Request
{
    protected $uri;
    protected $method;
    protected $attributes = [];
    
    public function __construct($uri, $method, $attributes = [])
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getContent()    {
        return file_get_contents('php://input');
    }
    
    

}