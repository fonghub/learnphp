<?php
namespace Task\Bll\Php7NewFeatures\AnonymousClasses;

/**
 * 通过new class来实例化匿名类的实例
 */
class Client
{
    public function index()
    {
        //返回实例
        // return new Anoymos();

        //返回匿名类的实例
        return new class implements Logger{
            public function log(string $msg){
                echo $msg;
            }
        };
    }
}