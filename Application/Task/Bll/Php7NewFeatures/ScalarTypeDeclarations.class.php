<?php
namespace Task\Bll\Php7NewFeatures;

/**
 * 默认情况下，PHP处于弱类型模式
 * 
 * 声明标量类型后，则处于强类型模式
 * 
 * 强类型模式分两种：
 * 1.强制类型模式（默认）
 * 2.严格模式，使用 declare(strict_types=1); 开启
 * 
 * 强制类型模式，我的理解是一种兼容的模式。在声明了形参类型后，即使实参数据类型不正确，系统会首先对强制转换参数（int、float和bool之间，string不可以），然后才进入方法
 * 
 * 严格模式下，PHP的变量就就想JAVA的一样，在进入函数前，系统首先会对参数类型进行验证，发现错误则抛出类型错误的异常
 */
class ScalarTypeDeclarations
{
    public function index(int ...$num)
    {
        return array_sum($num);
    }
}