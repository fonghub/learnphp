<?php

namespace Task\Bll\DP;

/*
 * 单例模式
 * 参考：https://www.cnblogs.com/sgm4231/p/9851725.html
 */
class Singleton
{

    private $vhost;

    //静态私有属性，用来保存当前类的实例
    //为什么必须是静态的?因为静态成员属于类,并被类所有实例所共享
    //为什么必须是私有的?不允许外部直接访问,仅允许通过类方法控制方法
    private static $instance = array();

    //构造器私有化:禁止从类外部实例化
    private function __construct($vhost)
    {
        echo "instance {$vhost}<br>";
        $this->vhost = $vhost;
    }

    //克隆方法私有化:禁止从外部克隆对象
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

    //唯一产生实例的途径
    //通过把类的实例保存在类里面，减少实例化的次数
    public static function getInstance($vhost)
    {
        if (!(self::$instance[$vhost] instanceof Singleton))
            self::$instance[$vhost] = new Singleton($vhost);

        return self::$instance[$vhost];
    }
}