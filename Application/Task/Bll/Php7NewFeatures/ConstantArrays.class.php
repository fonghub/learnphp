<?php
namespace Task\Bll\Php7NewFeatures;

/**
 * 常量语法参考：https://www.php.net/manual/zh/language.constants.syntax.php
 * 定义常量的两种方式：
 * 1.const关键字，使用const关键字在类内部定义常量，把常量当作类属性一样来访问
 * 2.define()方法，使用define()方法在类外部定义常量，到处可访问
 * 
 * 常量数组
 * PHP7之后可以使用define方法定义常量数组，也就是说以后可以在类方法里面定义常量数组了
 */
class ConstantArrays
{
    const ANIMALS = array('dog','cat','bird');

    public function index()
    {
        define("ANIMALS",array('dog','cat','bird'));
    }

}