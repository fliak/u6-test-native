<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 21.21
 */

namespace App\Model;



use App\Store\MysqlStore;

class DataModel
{
    /**
     * @var MysqlStore
     */
    protected $store;

    /**
     * DataModel constructor.
     * @param MysqlStore $store
     */
    public function __construct(MysqlStore $store)
    {
        $this->store = $store;
    }

    /**
     * @return mixed
     */
    public function getLastElement()   {
        $stmt = $this->store->getConnection()->prepare('SELECT * FROM `data` ORDER BY `id` DESC LIMIT 1');
        $stmt->execute();
        
        $data = $stmt->fetch();
        
        return $data;
    }

    /**
     * @param $data
     * @return bool
     */
    public function addElement($data)   {
        $stmt = $this->store->getConnection()->prepare('INSERT INTO `data` (`data`) VALUES (:data)');
        
        return $stmt->execute([
            ':data' => $data
        ]);
    }

    /**
     * @return string
     */
    public function getLastInsertId()   {
        return $this->store->getConnection()->lastInsertId();
    }

}