<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 20.24
 */

namespace App;


use App\Auth\Auth;
use App\Config\Config;
use App\Model\DataModel;
use App\Model\MenuModel;
use App\Session\SessionHandler;
use App\Store\MysqlStore;

class Builder
{

    /**
     * @var MysqlStore
     */
    protected $store;
    
    protected $models = [];

    /**
     * @var SessionHandler
     */
    protected $sessionHandler;

    /**
     * @var Auth
     */
    protected $auth;
    
    public function build() {
        $this->store = new MysqlStore(Config::getParam('db'));

        $this->models['menu'] = new MenuModel($this->store);
        $this->models['data'] = new DataModel($this->store);
        
        $this->sessionHandler = new SessionHandler();
        $this->auth = new Auth(Config::getParam('token_hash'), $this->sessionHandler);
        
        
    }

    /**
     * @return MysqlStore
     */
    public function getStore()
    {
        return $this->store;
    }
    
 
    public function getModel($modelName)    {
        if (!array_key_exists($modelName, $this->models))   {
            throw new \RuntimeException("Model \"$modelName\" is missing");
        }
        
        return $this->models[$modelName];
    }

    /**
     * @return SessionHandler
     */
    public function getSessionHandler()
    {
        return $this->sessionHandler;
    }

    /**
     * @return Auth
     */
    public function getAuth()
    {
        return $this->auth;
    }
    
    
    
}