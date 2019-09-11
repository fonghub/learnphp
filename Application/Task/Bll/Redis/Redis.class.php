<?php


namespace Task\Bll\Redis;


class Redis
{
    public $redis = null;

    public function __construct($conf)
    {
        $this->redis = \Task\Sdk\Redis\Redis::getInstance($conf);
    }

    public function getConn_str($key)
    {
        $conn = unserialize($this->redis->get($key));
        if (empty($conn) || !is_object($conn)){
            echo "inner<br>";
            $conn = new Tes($key);
            $this->redis->set($key,serialize($conn));
        }
        return $conn;
    }

    public function getConn_hash($key,$field)
    {
        $conn = unserialize($this->redis->hGet($key,$field));
        if (empty($conn) || !is_object($conn)){
            $conn = new Tes($field);
            $this->redis->hSet($key,$field,serialize($conn));
        }
        return $conn;
    }

}