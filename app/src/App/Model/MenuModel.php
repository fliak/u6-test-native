<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 21.21
 */

namespace App\Model;



use App\Store\MysqlStore;

class MenuModel
{
    /**
     * @var MysqlStore
     */
    protected $store;

    /**
     * MenuModel constructor.
     * @param MysqlStore $store
     */
    public function __construct(MysqlStore $store)
    {
        $this->store = $store;
    }
    
    
    public function getTree()   {
        $stmt = $this->store->getConnection()->prepare('SELECT * FROM `menu`');
        $stmt->execute();
        
        $data = $stmt->fetchAll();
        
        return $data;
    }

}