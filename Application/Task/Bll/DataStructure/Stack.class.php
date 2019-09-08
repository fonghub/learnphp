<?php


namespace Task\Bll\DataStructure;

/*
 * 栈
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/6.%E6%95%B0%E6%8D%AE%E7%BB%93%E6%9E%84%E4%B9%8B%E6%A0%88.md
 * 操作栈：
 * 入栈、出栈
 * 1。使用PHP数组函数array_pop和array_push模拟栈
 * 2。使用线性表添加元素和删除元素模拟栈（线性存储和链式存储）
 */

class Stack extends Linked
{


    public function pop()
    {
        $length = parent::get_length();
        return parent::del_item($length - 1);
    }

    public function push($item)
    {
        $length = parent::get_length();
        parent::add_item($length,$item);
    }

}