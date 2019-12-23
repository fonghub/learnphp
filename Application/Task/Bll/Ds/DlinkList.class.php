<?php


namespace Task\Bll\Ds;

class DlinkList
{

    /**
     * 初始化双向链表L
     */
    public function initList(&$L)
    {
        $L = new Node();
    }
    
    /**
     * 销毁双向链表L
     */
    public function destroyList(&$L)
    {
        $pre = $L;
        $p = $L->next;
        while ($p != null) {
            unset($pre);
            $pre = $p;
            $p = $p->next;
        }
        unset($pre);
    }
    
    /**
     * 若L为空表，则返回真，否则返回假
     */
    public function listEmpty($L)
    {
        return ($L->next == null);
    }
    
    /**
     * 双向链表L不为空时，显示L的长度
     * 为空时，显示0
     */
    public function listLength($L)
    {
        $length = 0;
        $pre = $L->next;
        while ($pre != null) {
            $length++;
            $pre = $pre->next;
        }
        return $length;
    }
    
    /**
     * 当双向链表L不为空时，顺序显示L中各节点的值域
     * 为空时，显示空数组
     */
    public function dispList($L)
    {
        $pre = $L->next;
        while ($pre != null) {
            echo $pre->data."\t";
            $pre = $pre->next;
        }
        echo "\n";
    }
    
    /**
     * 求双向链表L中指定位置的某个数据元素
     * 用e返回L中第 i 个元素的值
     */
    public function getElem($L,$i,&$e)
    {
        $j = 1;
        $pre = $L->next;
        while ($pre != null && $j < $i) {
            $j++;
            $pre = $pre->next;
        }

        if ($pre == null) {
            return false;
        }else{
            $e = $pre->data;
        }
        return true;
    }
    
    /**
     * 查找元素索引/序号
     * 返回双向链表L中第1个与e相等的序号，找不到返回0
     */
    public function locateElem($L,$e)
    {
        $pre = $L->next;
        $j = 1;
        while ($pre != null) {
            if ($pre->data == $e) {
                return $j;
            }
            $j++;
            $pre = $pre->next;
        }
        if ($pre == null) {
            return 0;
        }
    }
    
    /**
     * 插入元素
     * 在双向链表L中的第i个位置插入元素e
     */
    public function listInsert(&$L, $i, $e)
    {
        $j = 0;
        $p = $L;
        while ($j < $i - 1 && $p != null) {
            $p = $p->next;
            $j++;
        }

        if ($p == null) {
            return false;
        }
        $s = new Node();
        $s->data = $e;
        $s->next = $p->next;
        if ($p->next != null) {
            $p->next->pre = $s;
        }
        $s->pre = $p;
        $p->next = $s;
        return true;
    }
    
    /**
     * 删除元素
     * 在双向链表L中删除第i个元素，由e返回删除的值；
     */
    public function listDelete(&$L, $i, &$e)
    {
        $p = $L;
        $j = 0;
        while ($j < $i - 1 && $p != null) {
            $p = $p->next;
            $j++;
        }
        if ($p == null) {
            return false;
        }

        $s = $p->next;
        $p->next = $s->next;
        $s->next->pre = $p;
        $e = $s->data;
        unset($s);
        return true;
    }

    /**
     * 删除双向链表中所有值为$e的数据元素
     */
    // public function deduplication(&$L,$e)
    // {
    //     $p = $L;
    //     $q = $L->next;
    //     while ($q != null) {
    //         if ($q->data == $e) {
    //             $s = $q;
    //             $q = $q->next;
    //             unset($s);
    //         }else{
    //             $p->next = $q;
    //             $p = $q;
    //             $q = $q->next;
    //         }
    //     }
    // }

    /**
     * 创建双向链表-头插法
     */
    public function createListL(&$L,$arr)
    {
        $this->initList($L);
        foreach($arr as $k => $v){
            $s = new Node();
            $s->data = $v;
            $s->next = $L->next;
            if ($L->next != null) {
                $L->next->pres = $s;
            }
            $s->pres = $L;
            $L->next = $s;            
        }
    }

    /**
     * 创建双向链表-尾插法
     */
    public function createListR(&$L,$arr)
    {
        $this->initList($L);
        $r = $L;
        foreach($arr as $k => $v){
            $s = new Node();
            $s->data = $v;
            $r->next = $s;
            $s->pre = $r;

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
    public $pre = null;
    public $next = null;
}