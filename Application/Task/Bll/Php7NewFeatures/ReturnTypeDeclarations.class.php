<?php
namespace Task\Bll\Php7NewFeatures;

/**
 * 声明返回类型
 * 在函数括号后面跟上（: 类型），表示声明函数的返回值类型
 * 根据官方文档，开启严格模式后，如果返回值的类型与声明的类型不一致，就会产生一个致命错误
 * 但是，我这边的测试结果是，开不开启严格模式，返回值的类型与声明类型不一致都不会报错
 * 最后的结果可能会被强制类型转换为与声明的类型一直
 * 
 */
class ReturnTypeDeclarations
{
    public function index(int $num): int
    {
        return $num + 2.922222; //结果为int类型，不报错
    }
}