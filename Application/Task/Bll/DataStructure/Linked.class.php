<?php


namespace Task\Bll\DataStructure;

/*
 * 线性表-链式存储
 * https://github.com/elarity/data-structure-php-clanguage/blob/master/5.%E6%95%B0%E6%8D%AE%E7%BB%93%E6%9E%84%E4%B9%8B%E7%BA%BF%E6%80%A7%E8%A1%A8%EF%BC%88%E9%93%BE%E5%BC%8F%E5%AD%98%E5%82%A8%E8%A1%A8%EF%BC%89.md
 * 操作线性表功能：
 * 获取单链表长度
 * 从单链表中删除某个结点
 * 向单链表中添加一个结点
 * 清空整个单链表
 * 获取某个位置上的结点
 */
class Linked
{
    private $head = null;

    public function __construct()
    {
        $this->head = new Node();
    }

    /*
     * 获取单链表长度
     */
    public function get_length()
    {
        $length = 0;
        $head = $this->head;
        while ($head->next){
            $head = $head->next;
            $length++;
        }
        return $length;
    }

    /*
     * 新增节点
     */
    public function add_item($index,$item)
    {
        $length = $this->get_length();

        if ($index < 0 || $index > $length){
            return false;
        }

        $head = $this->head;
        for ($i = 0; $i < $index; $i++){
            $head = $head->next;
        }

        $node = new Node($item);
        $node->next = $head->next;
        $head->next = $node;
        return true;
    }


    /*
     * 删除节点，返回节点的值
     */
    public function del_item($index)
    {
        $length = $this->get_length();

        if ($index < 0 || $index > $length){
            return false;
        }

        $head = $this->head;
        for ($i = 0; $i < $index; $i++){
            $head = $head->next;
        }
        $del_node = $head->next;
        $value = $del_node->data;

        $head->next = $head->next->next;

        unset($del_node);
        return $value;
    }

    /*
     * 获取某个位置上的结点
     */
    public function get_item_by_index($index)
    {
        $length = $this->get_length();
        if ($index < 0 || $index > $length){
            return false;
        }
        $head = $this->head;
        for ($i = 0; $i < $index; $i++){
            $head = $head->next;
        }

        return $head->next->data;
    }

    /*
     * 清空链表
     */
    public function truncate()
    {
        $head = $this->head;
        while ($head->next){
            $temp = $head->next;
            unset($head->next);
            $head = $temp;
        }

        return true;
    }

    /*
     * 获取链表上所有元素
     */
    public function get_items()
    {
        $head = $this->head;
        $arr = array();
        while ($head->next){
            $head = $head->next;
            array_push($arr,$head->data);
        }

        return $arr;
    }

    /*
     * 中断链表
     */
    public function interrupt($index)
    {
        $length = $this->get_length();
        if ($index < 0 || $index > $length){
            return false;
        }
        $head = $this->head;
        for ($i = 0; $i < $index; $i++){
            $head = $head->next;
        }
        $head->next = null;
    }
}


class Node
{
    public $data = null;
    public $next = null;

    public function __construct($data = null)
    {
        $this->data = $data;
    }
}