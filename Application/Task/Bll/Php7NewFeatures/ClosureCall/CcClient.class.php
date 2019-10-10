<?php
namespace Task\Bll\Php7NewFeatures\ClosureCall;

class CcClient
{
    /**
     * 将闭包绑定到一个对象实例上，并执行该函数
     * 通过闭包，可以访问到类的私有属性
     */
    public function index($msg)
    {
        $getXcb = function(){
            return $this->x;
        };
        return $getXcb->call(new ClosureCall($msg));
    }

    /**
     * 无法通过类的实例访问到类的私有属性，报无访问权限错误
     */
    public function index2($msg)
    {
        $cc = new ClosureCall($msg);
        return $cc->x;
    }
}