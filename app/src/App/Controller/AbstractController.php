<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 21.31
 */

namespace App\Controller;


use App\Builder;

abstract class AbstractController
{
    /**
     * @var Builder
     */
    protected $appBuilder;

    /**
     * @return Builder
     */
    public function getAppBuilder()
    {
        return $this->appBuilder;
    }

    /**
     * @param Builder $appBuilder
     */
    public function setAppBuilder($appBuilder)
    {
        $this->appBuilder = $appBuilder;
    }
    
    
    
    
    

}