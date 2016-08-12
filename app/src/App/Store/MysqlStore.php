<?php
/**
 * Created by PhpStorm.
 * User: fliak
 * Date: 10.8.16
 * Time: 20.23
 */

namespace App\Store;


class MysqlStore
{
    /**
     * @var \PDO
     */
    protected $connection;

    public function __construct($dbConf)
    {

        $dsn = $this->buildDsn($dbConf);

        $this->connection = new \PDO($dsn, $dbConf['user'], $dbConf['password']);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

    }

    /**
     * @return \PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * @param array $params
     * @return string
     */
    protected function buildDsn(array $params)
    {
        $dsn = 'mysql:';
        if (array_key_exists('host', $params) && $params['host'] != '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }
        if (array_key_exists('port', $params)) {
            $dsn .= 'port=' . $params['port'] . ';';
        }
        if (array_key_exists('dbname', $params)) {
            $dsn .= 'dbname=' . $params['dbname'] . ';';
        }
        if (array_key_exists('charset', $params)) {
            $dsn .= 'charset=' . $params['charset'] . ';';
        }

        return $dsn;
    }

}