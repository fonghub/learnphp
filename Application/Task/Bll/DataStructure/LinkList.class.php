<?php


namespace Task\Bll\DataStructure;

class LinkList
{

    /**
     * 初始化单链表L
     */
    public function initList(&$L)
    {
        $L = new Node();
    }
    
    /**
     * 销毁单链表L
     */
    public function destroyList(&$L)
    {
        $L = null;
    }
    
    /**
     * 若L为空表，则返回真，否则返回假
     */
    public function listEmpty($L)
    {
        
    }
    
    /**
     * 单链表L不为空时，显示L的长度
     * 为空时，显示0
     */
    public function listLength($L)
    {
        
    }
    
    /**
     * 当单链表L不为空时，顺序显示L中各节点的值域
     * 为空时，显示空数组
     */
    public function dispList($L)
    {
        
    }
    
    /**
     * 求单链表L中指定位置的某个数据元素
     * 用e返回L中第 i 个元素的值
     */
    public function getElem($L,$i,&$e)
    {
        
    }
    
    /**
     * 查找元素索引/序号
     * 返回单链表L中第1个与e相等的序号，找不到返回0
     */
    public function locateElem($L,$e)
    {
        
    }
    
    /**
     * 插入元素
     * 在单链表L中的第i个位置插入元素e
     */
    public function listInsert(&$L, $i, $e)
    {
        
    }
    
    /**
     * 删除元素
     * 在单链表L中删除第i个元素，由e返回删除的值；
     */
    public function listDelete(&$L, $i, &$e)
    {
        
    }

    /**
     * 删除单链表中所有值为$e的数据元素
     */
    public function deduplication(&$L,$e)
    {
        
    }

    /**
     * 创建单链表-头插法
     */
    public function createListL(&$L,$arr)
    {
        $this->initList($L);
        foreach($arr as $k => $v){
            $s = new Node();
            $s->data = $v;
            $s->next = $L->next;
            $L->next = $s;            
        }
    }

    /**
     * 创建单链表-尾插法
     */
    public function createListR(&$L,$arr)
    {
        $this->initList($L);
        $r = $L;
        foreach($arr as $k => $v){
            $s = new Node();
            $s->data = $v;
            $r->next = $s;

            $r = $s;
        }
    }

}

/**
 * 节点
 */
class Node
{
    public $data = null;
    public $next = null;
}