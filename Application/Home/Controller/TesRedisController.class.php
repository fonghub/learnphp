<?php


namespace Home\Controller;


use Task\Bll\Redis\Redis;
use Task\Bll\Redis\Tes;

class TesRedisController
{

    public $config = array();
    public $key = "RedisConn";
    public $redis = null;
    public function __construct()
    {
        $this->config['host'] = C("REDIS_HOST");
        $this->config['port'] = C("REDIS_PORT");
        $this->config['auth'] = C("REDIS_AUTH");

        $this->redis = new Redis($this->config);
    }

    public function index()
    {
        echo 'redis-index';
    }

    public function getHash($vhost)
    {
        $conn = $this->redis->getConn_hash($this->key,$vhost);
        var_dump($conn);
        $conn->setVhost($vhost);
        var_dump($conn);
//        $item = $conn->getItem();
//        echo $item;
    }

    public function getStr($vhost)
    {
        $conn = $this->redis->getConn_str($vhost);
        var_dump($conn);
        $conn->setVhost($vhost);
        var_dump($conn);
    }
}