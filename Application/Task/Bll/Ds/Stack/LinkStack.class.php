<?php
namespace Task\Bll\Ds\Stack;


/**
 * 链栈本质上是使用头插法的链表
 */
class LinkStack
{
    /**
     * 初始化栈
     */
    public function initStack(&$s)
    {
        $s = new Stack();
    }

    /**
     * 销毁栈
     */
    public function destroyStack(&$s)
    {
        if($s->top != null){
            $pre = $s->top;
            $p = $pre->next;
            while($p != null){
                unset($pre);
                $pre = $p;
                $p = $p->next;
            }
            unset($pre);
        }
    }

    /**
     * 入栈
     */
    public function push(&$s,$e)
    {
        $node = new Node();
        $node->data = $e;
        if($this->stackEnpty($s)){
            $s->top = $node;
        }else{
            $node->next = $s->top;
            $s->top = $node;
        }
        $s->length++;
        return true;
    }

    /**
     * 出栈
     */
    public function pop(&$s,&$e)
    {
        if($this->stackEnpty($s)){
            return false;
        }
        $outer = $s->top;
        $e = $outer->data;
        $s->top = $outer->next;
        $s->length--;
        unset($outer);
        return true;
    }

    /**
     * 获取栈顶元素
     */
    public function getTop($s,&$e)
    {
        if($this->stackEnpty($s)){
            return false;
        }
        $e = $s->top->data;
        return true;
    }

    /**
     * 栈是否空
     */
    public function stackEnpty($s)
    {
        return ($s->top == null);
    }

    public function dispStack($s)
    {
        $top = $s->top;
        while ($top != null) {
            echo $top->data."\t";
            $top = $top->next;
        }
    }

    /**
     * 获取栈的长度
     */
    public function stackLength($s)
    {
        return $s->length;
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

/**
 * 栈
 */
class Stack
{
    public $top = null;
    public $length = 0;
}

?>