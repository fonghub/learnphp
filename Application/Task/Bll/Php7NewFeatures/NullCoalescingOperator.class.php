<?php
namespace Task\Bll\Php7NewFeatures;
/**
 * Null合并运算符 "??"
 * ??运算符有两个参数，??理解为存在并且不为null
 * 当第一个参数存在并且不为null的时候，返回第一个参数，否则返回第二个参数
 */
class NullCoalescingOperator
{
    public function index(string $name=null): string
    {
        // 语法：$name ?? "Null";
        //等效于：isset($name)?$name:"Null";
        return $name ?? "Null";
    }
}