<?php
namespace Task\Bll\Ds;


/**
 * 链栈本质上是使用头插法的链表
 */
class LinkStack
{
    /**
     * 初始化栈
     */
    public function initStack(&$s,$length)
    {
        $s = new Node();
    }

    /**
     * 销毁栈
     */
    public function DestroyStack(&$s)
    {
        $pre = $s;
        $top = $s->next;
        while ($top != null) {
            unset($pre);
            $pre = $top;
            $top = $top->next;
        }
        unset($pre);
    }

    /**
     * 入栈
     */
    public function push(&$s,$e)
    {
        $top = new Node();
        $top->data = $e;
        $top->next = $s->next;
        $s->next = $top;
    }

    /**
     * 出栈
     */
    public function pop(&$s,&$e)
    {
        if($this->stackEnpty($s)){
            return false;
        }
        $top = $s->next;
        $e = $top->data;
        $s->next = $top->next;
        unset($top);
        return true;
    }

    /**
     * 获取栈顶元素
     */
    public function getTop(&$s,&$e)
    {
        if($this->stackEnpty($s)){
            return false;
        }
        $e = $s->next->data;
        return true;
    }

    /**
     * 栈是否空
     */
    public function stackEnpty($s)
    {
        return ($s->next == null);
    }

    public function dispStack($s)
    {
        $top = $s;
        while ($top->next != null) {
            $top = $top->next;
            echo $top->data."\t";
        }
        echo "\n";
    }

    /**
     * 获取栈的长度
     */
    public function stackLength($s)
    {
        $i = 0;
        $top = $s;
        while ($top->next != null) {
            $i++;
            $top = $top->next;
        }
        return $i;
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

?>