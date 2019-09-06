<?php

namespace Task\Bll\DP;

class Singleton
{

    private $vhost;
    private static $instance = array();

    private function __construct($vhost)
    {
        echo "instance {$vhost}<br>";
        $this->vhost = $vhost;
    }

    private function __clone()
    {

    }

    public static function index()
    {
        echo 'index';
    }

    public function getVhost()
    {
        return $this->vhost;
    }

    public static function getInstance($vhost)
    {
        if (!(self::$instance[$vhost] instanceof Singleton))
            self::$instance[$vhost] = new Singleton($vhost);

        return self::$instance[$vhost];
    }
}